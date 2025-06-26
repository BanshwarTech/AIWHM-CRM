<?php

use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingController;

// 🔓 Public Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('login-post', 'loginPost')->name('login.post');
});

// 🔒 Protected Admin Routes
Route::middleware(['auth'])->group(function () {

    // 🧑‍💼 AdminController routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'dashboard')->name('admin.dashboard');

        Route::get('/profiles', 'profiles')->name('profiles');
        Route::get('/manage-profile/{id?}', 'manageProfile')->name('manage.profile');
    });

    // ⚙️ SettingController routes
    Route::controller(SettingController::class)->group(function () {
        Route::get('/admin/mail-settings', 'mailSettings')->name('admin.mail.settings');
        Route::post('/admin/mail-settings/update', 'mailSettingsUpdate')->name('admin.mail.settings.update');

        Route::get('/admin/whmcs-api-settings', 'whmcsApiSettings')->name('admin.whmcs.api.settings');
        Route::post('/admin/whmcs-api-settings/update', 'updateWhmcsApiSettings')->name('admin.whmcs.api.settings.update');
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});
