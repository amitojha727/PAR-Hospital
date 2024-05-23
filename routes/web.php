<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/cache-clear', function () {
    $exitCode = Artisan::call('cache:clear');
    echo "Cache Cleard: " . $exitCode;
});

Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    echo "View Cleard: " . $exitCode;
});

Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    echo "Route Cache Cleared: " . $exitCode;
});

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    echo "Config Cached: " . $exitCode;
});

Route::get('/config-clear', function () {
    $exitCode = Artisan::call('config:clear');
    echo "Config Cache Cleared: " . $exitCode;
});
Route::get('/foo', function () {
    Artisan::call('storage:link');
});
// dd('hii');
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/department', [HomeController::class, 'department'])->name('department');
Route::get('/department/{var}', [HomeController::class, 'departmentDetails'])->name('department.details');
Route::get('/doctor', [HomeController::class, 'doctor'])->name('doctor');
Route::get('/doctor/{var}', [HomeController::class, 'doctorDetails'])->name('doctor.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/appoinment', [HomeController::class, 'appoinment'])->name('appoinment');

//appointment
Route::post('/appoinment-doctor-list', [AppointmentController::class, 'doctorList'])->name('web.appointment.doctor');
Route::post('/appoinment-add', [AppointmentController::class, 'appointmentAdd'])->name('web.appointment.add');

//contact us
Route::post('/contact-add', [ContactController::class, 'contactAdd'])->name('web.contact.add');

//subscribe
Route::post('add-subcribe',[HomeController::class, 'subcribe'])->name('web.subscribe');