<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
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

    $adminPrefix = "audittrails";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('audit-trails', [AuditTrailsController::class, 'list'])->name('audit-trails');
        Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    });

    $adminPrefix = "users";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('import-subscriber', [SubscriberController::class, 'import'])->name('import-subscriber');
        Route::post('save-import-subscriber', [SubscriberController::class, 'save_import'])->name('save-import-subscriber');

        Route::get('subscriber-list', [SubscriberController::class, 'list'])->name('subscriber-list');
        Route::get('subscriber-add', [SubscriberController::class, 'add'])->name('subscriber-add');
        Route::post('save-subscriber-add', [SubscriberController::class, 'save_subscriber_add'])->name('save-subscriber-add');
        Route::get('subscriber-edit/{id}', [SubscriberController::class, 'edit'])->name('subscriber-edit');
        Route::post('save-subscriber-edit', [SubscriberController::class, 'save_subscriber_edit'])->name('save-subscriber-edit');
        Route::get('subscriber-view/{id}', [SubscriberController::class, 'view'])->name('subscriber-view');
        Route::post('subscriber-ajaxcall', [SubscriberController::class, 'ajaxcall'])->name('subscriber-ajaxcall');
        
    });
});



?>
