<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\brand_entry\BrandentryController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;

use App\Http\Controllers\backend\users\UsersController;
use App\Http\Controllers\backend\users\SubscriberController;

Route::get('admin-logout', [LoginController::class, 'logout'])->name('admin-logout');

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('admin-update-profile', [DashboardController::class, 'update_profile'])->name('admin-update-profile');
    Route::post('admin-save-profile', [DashboardController::class, 'save_profile'])->name('admin-save-profile');

    Route::get('admin-change-password', [DashboardController::class, 'change_password'])->name('admin-change-password');
    Route::post('save-password', [DashboardController::class, 'save_password'])->name('save-password');

    Route::post('common-ajaxcall', [CommonController::class, 'ajaxcall'])->name('common-ajaxcall');

    Route::get('admin-system-setting',[SystemsettingController::class,'system_setting'])->name('admin-system-setting');
    Route::post('save-system-setting',[SystemsettingController::class,'system_setting'])->name('save-system-setting');

    // Route::get('smtp-setting',[SmtpsettingController::class,'smtp_setting'])->name('smtp-setting');
    // Route::post('save-smtp-setting',[SmtpsettingController::class,'smtp_setting'])->name('save-smtp-setting');

    //brand-entry
    Route::get('brand-entry-list', [BrandentryController::class, 'list'])->name('brand-entry-list');
    Route::post('brand-entry-ajaxcall', [BrandentryController::class, 'ajaxcall'])->name('brand-entry-ajaxcall');
    Route::get('add-brand-entry', [BrandentryController::class, 'add'])->name('add-brand-entry');
    Route::post('add-save-brand-entry', [BrandentryController::class, 'add_brand_entry'])->name('add-save-brand-entry');
    Route::get('edit-brand-entry/{id}', [BrandentryController::class, 'edit'])->name('edit-brand-entry');
    Route::post('edit-save-brand-entry', [BrandentryController::class, 'edit_brand_entry'])->name('edit-save-brand-entry');


    $adminPrefix = "audittrails";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('audit-trails', [AuditTrailsController::class, 'list'])->name('audit-trails');
        Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    });

    // $adminPrefix = "brand-entry";
    // Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {

    //     Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    // });
});



?>
