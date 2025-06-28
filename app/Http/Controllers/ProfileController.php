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

    public function manageProfile($id = null)
    {
        $users = User::find($id); // returns a single user or null
        return view('common.manage-profile', compact('users'));

    }
    

    public function manageProfilePost(Request $request, $id= null)
    {
        $emailRule = $request->id
        ? 'nullable|email|unique:users,email,' . $request->id
        : 'required|email|unique:users';
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => $emailRule,
            'phone' => 'required|string',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
            'department' => 'required|string',
            'position' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if(isset($request->id)) {
           $user = User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'decrypted_password' => $request->password,
            'encrypted_password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'position' => $request->position,
        ]); 
        $msg="Updated data successfully!";
        
        } else {
            User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'phone' => $request->phone,
            'address' => $request->address,
            'decrypted_password' => $request->password,
            'encrypted_password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'position' => $request->position,
            ]);
            $msg="User created successfully!";
        
        }

        return redirect()->back()->with('success', $msg);
    }
}

