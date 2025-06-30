<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $result['users'] = User::all();
        $result['departments'] = User::select('department')->distinct()->pluck('department');
        $result['user'] = currentUser();
        return view('admin.profile', $result);
    }

    public function manageProfile()
    {
        $result['user'] = currentUser();
        return view('common.manage-profile', $result);
    }

    public function manageProfilePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string',
            'address'  => 'required|string',
            'password' => 'required|string|min:6',
            'role'     => 'required|string',
            'department' => 'required|string',
            'position'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'email_verified_at'    => now(),
            'phone'    => $request->phone,
            'address'  => $request->address,
            'decrypted_password' => $request->password,
            'encrypted_password' => Hash::make($request->password),
            'role'     => $request->role,
            'department' => $request->department,
            'position'   => $request->position,
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function myProfile()
    {
        $result['profile'] = User::where('email', session('USER_EMAIL'))->first();
        $result['user'] = currentUser();
        // dd($result);
        return view('common.your-profile', $result);
    }

    public function updateMyProfile(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'phone'    => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'address'  => 'required|string',
            'profile_image' => 'nullable|image', // max 2MB
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->post('id'));
        $user->name = $request->post('name');
        $user->phone = $request->post('phone');
        $user->gender = $request->post('gender');
        $user->dob = $request->post('dob');
        $user->address = $request->post('address');


        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $user->profile_image = $imageName;
        }


        // Update existing
        $user->save();
        $message = 'Profile updated successfully.';

        return redirect()->back()->with('success', $message);
    }
}
