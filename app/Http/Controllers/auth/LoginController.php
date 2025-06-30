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
use Illuminate\Support\Facades\Session;

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
            session()->put('USER_DEPARTMENT', $user->department);

            // ✅ Determine redirect based on role
            if ($user->role === 'admin') {
                $redirectUrl = route('admin.dashboard');
            } elseif ($user->role === 'team-leader') {
                switch ($user->department) {
                    case 'sales':
                        $redirectUrl = route('team.leader.sales.dashboard');
                        break;
                    case 'support':
                        $redirectUrl = route('team.leader.support.dashboard');
                        break;
                    case 'seo':
                        $redirectUrl = route('team.leader.seo.dashboard');
                        break;
                    case 'development':
                        $redirectUrl = route('team.leader.development.dashboard');
                        break;
                    default:
                        abort(403, 'Unauthorized department for team-leader.');
                }
            } elseif ($user->role === 'team-member') {
                switch ($user->department) {
                    case 'sales':
                        $redirectUrl = route('team.member.sales.dashboard');
                        break;
                    case 'support':
                        $redirectUrl = route('team.member.support.dashboard');
                        break;
                    case 'seo':
                        $redirectUrl = route('team.member.seo.dashboard');
                        break;
                    case 'development':
                        $redirectUrl = route('team.member.development.dashboard');
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
        Session::flush();
        auth()->logout();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }





    public function updatePassword(Request $request)
    {
        try {
            // Step 1: Get current user using session (or use Auth::user())
            $user = User::where('email', session('USER_EMAIL'))->first();

            if (!$user) {
                return back()->withErrors(['old_password' => 'User not found'])->withInput();
            }

            // Step 2: Check if old password is entered
            if (!$request->filled('old_password')) {
                return back()->withErrors(['old_password' => 'Old password is required'])->withInput();
            }

            // Step 3: Check if old password is correct
            if (!Hash::check($request->old_password, $user->encrypted_password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
            }

            // ✅ Only after old password is validated, validate the rest
            $request->validate([
                'new_password' => [
                    'required',
                    'min:6',
                    'different:old_password',
                ],
                'new_password_confirmation' => 'required|same:new_password',
            ], [
                'new_password.required' => 'New password is required',
                'new_password.min' => 'New password must be at least 6 characters',
                'new_password.different' => 'New password must be different from the old password',
                'new_password_confirmation.required' => 'Please confirm your new password',
                'new_password_confirmation.same' => 'Confirm password does not match new password',
            ]);

            // Step 4: Update password
            $user->update([
                'encrypted_password' => Hash::make($request->new_password),
                'decrypted_password' => $request->new_password // optional — remove if not needed
            ]);

            // Step 5: Logout user
            Session::flush(); // clears all session data
            auth()->logout();

            return redirect()->route('login')->with('success', 'Password updated successfully. Please log in again.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }



    public function generateHashPassword()
    {
        return Hash::make('nP6@zB!vT9#eW3qY');
    }
}
