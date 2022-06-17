<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\brand_entry\BrandentryController;
use App\Http\Controllers\backend\CommonController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;
use App\Http\Controllers\backend\user_management\UserManagementController;
use App\Http\Controllers\backend\users\UsersController;
use App\Http\Controllers\backend\users\SubscriberController;
use App\Http\Controllers\backend\device\DiviceController;
use App\Http\Controllers\backend\mobile_number\MobilenumberController;
use App\Http\Controllers\backend\import_data\ImportdataController;

Route::get('admin-logout', [LoginController::class, 'logout'])->name('admin-logout');

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
    Route::get('my-report', [DashboardController::class, 'dashboard'])->name('my-report');
    Route::get('update-report', [DashboardController::class, 'update_report'])->name('update-report');
    Route::get('download-excel-download', [DashboardController::class, 'download_excel_download'])->name('download-excel-download');
    Route::post('my-report-ajaxcall', [DashboardController::class, 'ajaxcall'])->name('my-report-ajaxcall');

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
    Route::POST('run-script', [BrandentryController::class, 'run_script'])->name('run-script');
    Route::post('brand-entry-ajaxcall', [BrandentryController::class, 'ajaxcall'])->name('brand-entry-ajaxcall');
    Route::get('add-brand-entry', [BrandentryController::class, 'add'])->name('add-brand-entry');
    Route::post('add-save-brand-entry', [BrandentryController::class, 'add_brand_entry'])->name('add-save-brand-entry');
    Route::get('edit-brand-entry/{id}', [BrandentryController::class, 'edit'])->name('edit-brand-entry');
    Route::post('edit-save-brand-entry', [BrandentryController::class, 'edit_brand_entry'])->name('edit-save-brand-entry');
    Route::get('export-brand-details', [BrandentryController::class, 'get_brand_data'])->name('export-brand-details');

    //user management
    Route::get('user-management-list', [UserManagementController::class, 'list'])->name('user-management-list');
    Route::get('add-user-management', [UserManagementController::class, 'add'])->name('add-user-management');
    Route::post('add-save-user-management', [UserManagementController::class, 'add_user_management'])->name('add-save-user-management');
    Route::get('edit-user-management/{id}', [UserManagementController::class, 'edit'])->name('edit-user-management');
    Route::post('edit-save-user-management', [UserManagementController::class, 'edit_user_management'])->name('edit-save-user-management');

    Route::post('user-management-ajaxcall', [UserManagementController::class, 'ajaxcall'])->name('user-management-ajaxcall');

    //device
    Route::get('device-list', [DiviceController::class, 'list'])->name('device-list');
    Route::get('add-device', [DiviceController::class, 'add'])->name('add-device');
    Route::post('add-save-device', [DiviceController::class, 'add_device'])->name('add-save-device');
    Route::get('edit-device/{id}', [DiviceController::class, 'edit'])->name('edit-device');
    Route::post('edit-save-device', [DiviceController::class, 'edit_device'])->name('edit-save-device');

    Route::post('device-ajaxcall', [DiviceController::class, 'ajaxcall'])->name('device-ajaxcall');

    //mobile number
    Route::get('mobile-number-list', [MobilenumberController::class, 'list'])->name('mobile-number-list');
    Route::get('add-mobile-number', [MobilenumberController::class, 'add'])->name('add-mobile-number');
    Route::post('add-save-mobile-number', [MobilenumberController::class, 'add_mobile_number'])->name('add-save-mobile-number');
    Route::get('edit-mobile-number/{id}', [MobilenumberController::class, 'edit'])->name('edit-mobile-number');
    Route::post('edit-save-mobile-number', [MobilenumberController::class, 'edit_mobile_number'])->name('edit-save-mobile-number');

    Route::post('mobile-number-ajaxcall', [MobilenumberController::class, 'ajaxcall'])->name('mobile-number-ajaxcall');

    Route::get('import-brands', [ImportdataController::class, 'import_brands'])->name('import-brands');
    Route::post('import-brands-save', [ImportdataController::class, 'import_brands_save'])->name('import-brands-save');
    // Route::post('import-brands-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('import-brands-ajaxcall');

    $adminPrefix = "audittrails";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('audit-trails', [AuditTrailsController::class, 'list'])->name('audit-trails');
        Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    });

    

});



?>
