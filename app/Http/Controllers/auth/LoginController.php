<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Helpers\MailConfigHelper;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $formType = $request->form_type;

        if ($formType === 'login') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed.'
                ]);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->encrypted_password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials.'
                ]);
            }

            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_created_at = now();
            $user->save();

            try {
                MailConfigHelper::getMailSettings();
                // dd(MailConfigHelper::getMailSettings());
                Mail::to($request->email)->send(new OtpMail($otp));
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent to your email.',
                    'email' => $user->email
                ]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Email send failed.']);
            }
        }

        if ($formType === 'otp') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'otp' => 'required|digits:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Invalid OTP input.'
                ]);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user || $user->otp != $request->otp) {
                return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
            }

            $user->otp = null;
            $user->otp_created_at = null;
            $user->save();

            auth()->login($user);

            // ✅ Save email and role in session
            session()->put('USER_ID', $user->id);
            session()->put('USER_NAME', $user->name);
            session()->put('USER_EMAIL', $user->email);
            session()->put('USER_PROFILE_IMAGE', $user->profile_image); // Use default if profile image is null
            session()->put('USER_ROLE', $user->role);


            // ✅ Determine redirect based on role
            if ($user->role === 'admin') {
                $redirectUrl = route('admin.dashboard');
            } elseif ($user->role === 'team-leader') {
                switch ($user->department) {
                    case 'sales':
                        $redirectUrl = route('team-leader.sales.dashboard');
                        break;
                    case 'support':
                        $redirectUrl = route('team-leader.support.dashboard');
                        break;
                    case 'seo':
                        $redirectUrl = route('team-leader.seo.dashboard');
                        break;
                    case 'development':
                        $redirectUrl = route('team-leader.development.dashboard');
                        break;
                    default:
                        abort(403, 'Unauthorized department for team-leader.');
                }
            } elseif ($user->role === 'team-member') {
                switch ($user->department) {
                    case 'sales':
                        $redirectUrl = route('team-member.sales.dashboard');
                        break;
                    case 'support':
                        $redirectUrl = route('team-member.support.dashboard');
                        break;
                    case 'seo':
                        $redirectUrl = route('team-member.seo.dashboard');
                        break;
                    case 'development':
                        $redirectUrl = route('team-member.development.dashboard');
                        break;
                    default:
                        abort(403, 'Unauthorized department for team-member.');
                }
            } else {
                abort(403, 'Unauthorized role.');
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP verified.',
                'redirect' => $redirectUrl
            ]);
        }

        if ($formType === 'resend_otp') {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }

            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_created_at = now();
            $user->save();

            try {
                MailConfigHelper::getMailSettings();
                Mail::to($user->email)->send(new OtpMail($otp));
                return response()->json(['success' => 'OTP resent successfully.']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to resend OTP.'], 500);
            }
        }

        return response()->json(['error' => 'Invalid form type.'], 400);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function generateHashPassword()
    {
        return Hash::make('nP6@zB!vT9#eW3qY');
    }
}
