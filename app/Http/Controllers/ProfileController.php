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
        return view('admin.profile', $result);
    }

    public function manageProfile()
    {
        return view('common.manage-profile');
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
}
