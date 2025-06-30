<?php

use App\Models\User;

if (!function_exists('currentUser')) {
    function currentUser()
    {
        // Get user by session email
        return User::where('email', session('USER_EMAIL'))->first();
    }
}
