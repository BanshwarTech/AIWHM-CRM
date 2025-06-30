<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $result['user'] = currentUser();
        return view('admin.dashboard', $result);
    }

    // hash password generate

}
