<?php
use App\Http\Controllers\Employee\EmployeeLoginController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\ClientController;

Route::get('employee-login', [EmployeeLoginController::class, 'index'])->name('employee.login');
Route::post('employeelogin', [EmployeeLoginController::class, 'employeelogin']);
Route::get('employee-dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
Route::get('employee-logout', [EmployeeController::class, 'logout'])->name('employee.logout');
Route::get('employee-change-password', [EmployeeController::class, 'changePassword'])->name('employee.changePassword');
Route::post('employee-change-password', [EmployeeController::class, 'changePasswordStore'])->name('employee.changePasswordStore');

// Clients
Route::group(['prefix' => 'client'], function () {
    Route::get('details', [ClientController::class, 'index'])->name('employee.clients');
    Route::get('add', [ClientController::class, 'create'])->name('employee.clientAdd');
    Route::post('add', [ClientController::class, 'store'])->name('employee.clientStore');
    Route::post('update/{var}', [ClientController::class, 'update'])->name('employee.clientUpdate');
    Route::get('delete', [ClientController::class, 'delete'])->name('employee.clientDelete');
    Route::get('add-form-details', [ClientController::class, 'addDetails'])->name('employee.client.addDetails');
    Route::post('add-form-details', [ClientController::class, 'storeDetails'])->name('employee.client.storeDetails');
    Route::get('view-form-details', [ClientController::class, 'viewDetails'])->name('employee.client.viewDetails');
    Route::post('update-form-details/{var}', [ClientController::class, 'updateDetails'])->name('employee.client.updateDetails');
    Route::get('delete-form-details', [ClientController::class, 'deleteDetails'])->name('employee.client.deleteDetails');
    Route::get('view-report-form-details', [ClientController::class, 'reportDetails'])->name('employee.client.reportDetails');
    Route::post('report-form-ajaxhtml-pdf', [ClientController::class, 'reportAjaxPDF'])->name('employee.client.reportAjaxPDF');
    Route::get('report-form-generate-pdf', [ClientController::class, 'reportPDF'])->name('employee.client.reportPDF');
    Route::post('report-form-generate-print', [ClientController::class, 'reportAjaxPrint'])->name('employee.client.reportAjaxPrint');
    Route::get('report-excel', [ClientController::class, 'reportExcel'])->name('employee.client.reportExcel');
    Route::post('report-excel', [ClientController::class, 'reportExcelStore'])->name('employee.client.reportExcelStore');
    Route::get('report-excel-employee', [ClientController::class, 'reportExcelEmployee'])->name('employee.client.reportExcelEmployee');
    Route::get('report-excel-client', [ClientController::class, 'reportExcelClient'])->name('employee.client.reportExcelClient');
    Route::get('report-excel-generate-client', [ClientController::class, 'reportExcelClientGenerate'])->name('employee.client.reportExcelClientGenerate');
    Route::get('report-excel-generate-form', [ClientController::class, 'reportExcelFormGenerate'])->name('employee.client.reportExcelFormGenerate');
});