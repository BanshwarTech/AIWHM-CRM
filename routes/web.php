<?php


use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\TeamLeader\TeamLeaderController;
use App\Http\Controllers\TeamMember\TeamMemberController;
use Illuminate\Http\Request;

// 🔓 Public Login Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('login-post', 'loginPost')->name('login.post');
});

// 🔒 Protected Admin Routes
// Route::middleware(['auth'])->group(function () {

    // 📝 Task Management
    Route::prefix('tasks')->controller(TaskController::class)->group(function () {
        Route::get('/', 'tasks')->name('tasks');
        Route::get('/manage/{id?}', 'manageTasks')->name('manage.tasks');
        Route::post('/manage/create/{id?}', 'manageTasksCreate')->name('manage.tasks.create');
        Route::delete('/destroy/{id}', 'destroyTask')->name('tasks.destroy');
        Route::get('/view/{id}', 'viewTask')->name('tasks.view');
    });


Route::get('/admin/profiles', [ProfileController::class, 'profile'])->name('manage.profiles');
Route::post('/profile/insert', [ProfileController::class, 'insert'])->name('profile.insert');
    // ⚙️ SettingController routes
    Route::controller(SettingController::class)->group(function () {
        Route::get('/admin/mail-settings', 'mailSettings')->name('admin.mail.settings');
        Route::post('/admin/mail-settings/update', 'mailSettingsUpdate')->name('admin.mail.settings.update');

        Route::get('/admin/whmcs-api-settings', 'whmcsApiSettings')->name('admin.whmcs.api.settings');
        Route::post('/admin/whmcs-api-settings/update', 'updateWhmcsApiSettings')->name('admin.whmcs.api.settings.update');
    });

<<<<<<< HEAD
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
// });

=======
    // 👤 Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/manage-profiles', 'manageProfile')->name('manage.profiles');
        Route::post('/manage-profiles/create', 'manageProfilePost')->name('manage.profiles.create');
        Route::get('/my-profile', 'myProfile')->name('my.profile');
        Route::put('my-profile/update', 'updateMyProfile')->name('my.profile.update');
    });

    // 🔚 Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // 👨‍💼 Team Leader Dashboards
    Route::prefix('team-leader')->controller(TeamLeaderController::class)->group(function () {
        Route::get('/sales/dashboard', 'salesDashboard')->name('team.leader.sales.dashboard');
        Route::get('/support/dashboard', 'supportDashboard')->name('team.leader.support.dashboard');
        Route::get('/seo/dashboard', 'seoDashboard')->name('team.leader.seo.dashboard');
        Route::get('/development/dashboard', 'developmentDashboard')->name('team.leader.development.dashboard');
    });

    // 👨‍🔧 Team Member Dashboards
    Route::prefix('team-member')->controller(TeamMemberController::class)->group(function () {
        Route::get('/sales/dashboard', 'salesDashboard')->name('team.member.sales.dashboard');
        Route::get('/support/dashboard', 'supportDashboard')->name('team.member.support.dashboard');
        Route::get('/seo/dashboard', 'seoDashboard')->name('team.member.seo.dashboard');
        Route::get('/development/dashboard', 'developmentDashboard')->name('team.member.development.dashboard');
    });
});
>>>>>>> 07e5eca027b68ae15e44530111aa8cdb0c633768
