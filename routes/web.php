<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\TeamLeader\TeamLeaderController;
use App\Http\Controllers\TeamMember\TeamMemberController;

// 🔓 Public Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('login-post', 'loginPost')->name('login.post');
    Route::get('/hash-password', 'generateHashPassword')->name('hash.password');
});

// 🔒 Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {

    // 🧑 Admin Dashboard
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // 📝 Task Management
    Route::prefix('tasks')->controller(TaskController::class)->group(function () {
        Route::get('/', 'tasks')->name('tasks');
        Route::get('/manage/{id?}', 'manageTasks')->name('manage.tasks');
        Route::post('/manage/create/{id?}', 'manageTasksCreate')->name('manage.tasks.create');
        Route::delete('/destroy/{id}', 'destroyTask')->name('tasks.destroy');
    });

    // ⚙️ Settings
    Route::prefix('admin')->controller(SettingController::class)->group(function () {
        Route::get('/mail-settings', 'mailSettings')->name('admin.mail.settings');
        Route::post('/mail-settings/update', 'mailSettingsUpdate')->name('admin.mail.settings.update');
        Route::get('/whmcs-api-settings', 'whmcsApiSettings')->name('admin.whmcs.api.settings');
        Route::post('/whmcs-api-settings/update', 'updateWhmcsApiSettings')->name('admin.whmcs.api.settings.update');
    });

    // 👤 Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/manage-profiles', 'manageProfile')->name('manage.profiles');
        Route::post('/manage-profiles/create', 'manageProfilePost')->name('manage.profiles.create');
    });

    // 🔚 Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // 👨‍💼 Team Leader Dashboards
    Route::prefix('team-leader')->controller(TeamLeaderController::class)->group(function () {
        Route::get('/sales/dashboard', 'salesDashboard')->name('team-leader.sales.dashboard');
        Route::get('/support/dashboard', 'supportDashboard')->name('team-leader.support.dashboard');
        Route::get('/seo/dashboard', 'seoDashboard')->name('team-leader.seo.dashboard');
        Route::get('/development/dashboard', 'developmentDashboard')->name('team-leader.development.dashboard');
    });

    // 👨‍🔧 Team Member Dashboards
    Route::prefix('team-member')->controller(TeamMemberController::class)->group(function () {
        Route::get('/sales/dashboard', 'salesDashboard')->name('team-member.sales.dashboard');
        Route::get('/support/dashboard', 'supportDashboard')->name('team-member.support.dashboard');
        Route::get('/seo/dashboard', 'seoDashboard')->name('team-member.seo.dashboard');
        Route::get('/development/dashboard', 'developmentDashboard')->name('team-member.development.dashboard');
    });
});
