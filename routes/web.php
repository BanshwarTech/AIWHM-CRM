<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/mail-settings', [SettingController::class, 'mailSettings'])->name('admin.mail.settings');
Route::post('/admin/mail-settings/update', [SettingController::class, 'mailSettingsUpdate'])->name('admin.mail.settings.update');


Route::get('/admin/whmcs-api-settings', [SettingController::class, 'whmcsApiSettings'])->name('admin.whmcs.api.settings');
Route::post('/admin/whmcs-api-settings/update', [SettingController::class, 'updateWhmcsApiSettings'])->name('admin.whmcs.api.settings.update');

Route::get('/admin/profiles', [AdminController::class, 'profiles'])->name('admin.profiles');
Route::get('/admin/manage-profile/{id?}', [AdminController::class, 'manageProfile'])->name('admin.manage.profile');
