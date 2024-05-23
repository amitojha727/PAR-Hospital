<?php
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminSubscriberController;
Route::get('crm', [AdminLoginController::class, 'index'])->name('admin.login');
// dd('hiiiiii');
Route::post('adminlogin', [AdminLoginController::class, 'adminlogin']);

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout2');
Route::get('admin/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword2');
Route::post('admin/change-password', [AdminController::class, 'changePasswordStore'])->name('admin.changePasswordStore2');
// dd('hiii');
// sites
Route::group(['prefix' => 'site'], function () {
    Route::get('details', [SiteController::class, 'index'])->name('admin.sites');
    Route::get('add', [SiteController::class, 'create'])->name('admin.siteAdd');
    Route::post('add', [SiteController::class, 'store'])->name('admin.siteStore');
    Route::post('update/{var}', [SiteController::class, 'update'])->name('admin.siteUpdate');
    Route::get('delete', [SiteController::class, 'delete'])->name('admin.siteDelete');
});
// employee
Route::group(['prefix' => 'employee'], function () {
    Route::get('details', [EmployeeController::class, 'index'])->name('admin.employees');
    Route::get('add', [EmployeeController::class, 'create'])->name('admin.employeeAdd');
    Route::post('add', [EmployeeController::class, 'store'])->name('admin.employeeStore');
    Route::post('update/{var}', [EmployeeController::class, 'update'])->name('admin.employeeUpdate');
    Route::get('delete', [EmployeeController::class, 'delete'])->name('admin.employeeDelete');
    Route::get('change-password', [EmployeeController::class, 'changePassword'])->name('admin.employeeChangePassword');
    Route::post('change-password', [EmployeeController::class, 'changePasswordStore'])->name('admin.employee.changePasswordStore');
    Route::get('view-qualification', [EmployeeController::class, 'Qualification'])->name('admin.employee.qualification');
    Route::get('add-qualification', [EmployeeController::class, 'addQualification'])->name('admin.employee.add.qualification');
    Route::post('add-qualification-post', [EmployeeController::class, 'addQualificationPost'])->name('admin.employee.add.qualification.post');
    Route::post('update-qualification/{var}', [EmployeeController::class, 'updateQualification'])->name('admin.qualification.update');
    Route::get('delete-qualification', [EmployeeController::class, 'deleteQualification'])->name('admin.employee.delete.qualification');
});
//appointment
Route::group(['prefix' => 'appointment'], function () {
    Route::get('details', [AdminAppointmentController::class, 'show'])->name('admin.show.appointment');
});
//Contact Us
Route::group(['prefix' => 'Contacts'], function () {
    Route::get('details', [AdminContactController::class, 'show'])->name('admin.show.contact');
});
//subscriber
Route::group(['prefix' => 'Subscriber'], function () {
    Route::get('details', [AdminSubscriberController::class, 'show'])->name('admin.show.subscriber');
});