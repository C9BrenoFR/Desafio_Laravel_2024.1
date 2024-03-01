<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/surgery', 'App\Http\Controllers\Controller@appointment')->name('surgery');


Route::post('/completeregister', 'App\Http\Controllers\UserController@completeregister')
->middleware(['auth', 'verified'])->name('completeregister');
Route::get('/user/create', 'App\Http\Controllers\UserController@create')
->middleware(['auth', 'verified'])->name('user.create');
Route::post('/profileupdate', 'App\Http\Controllers\UserController@update')
->middleware(['auth', 'verified'])->name('profileupdate');
Route::post('/passwordupdate', 'App\Http\Controllers\UserController@passwordupdate')
->middleware(['auth', 'verified'])->name('user.update.password');
Route::post('/profiledelete/{$id}', 'App\Http\Controllers\UserController@destroy')
->middleware(['auth', 'verified'])->name('user.delete');


Route::post('/surgery/confirm', 'App\Http\Controllers\SurgeryController@create')
->middleware(['auth', 'verified'])->name('surgery.confirm');
Route::post('/surgery/create', 'App\Http\Controllers\SurgeryController@store')
->middleware(['auth', 'verified'])->name('surgery.create');
Route::post('/surgery/delete', 'App\Http\Controllers\SurgeryController@destroy')
->middleware(['auth', 'verified'])->name('surgery.delete');


Route::middleware('admin')->group(function(){

    Route::get('/adminDashboard', function () {
        return view('admin.adminDashboard');
    })->name('adminDashboard');

    Route::get('/adminlogout', function () {
        Auth::guard('admin')->logout();

        return redirect('/');
    })->name('adminlogout');

    Route::get('/admin/specialty', 'App\Http\Controllers\SpecialtyController@index')
    ->name('admin.specialty');
    Route::post('/admin/specialty/store', 'App\Http\Controllers\SpecialtyController@store')
    ->name('admin.specialty.store');
    Route::post('/admin/specialty/edit/{id}', 'App\Http\Controllers\SpecialtyController@edit')
    ->name('admin.specialty.edit');
    Route::delete('/admin/specialty/destroy/{specialty}', 'App\Http\Controllers\SpecialtyController@destroy')
    ->name('admin.specialty.destroy');

    Route::get('/admin/healthplan', 'App\Http\Controllers\HealthPlanController@index')
    ->name('admin.healthplan');
    Route::post('/admin/healthplan/store', 'App\Http\Controllers\HealthplanController@store')
    ->name('admin.healthplan.store');
    Route::post('/admin/healthplan/edit/{healthplan}', 'App\Http\Controllers\HealthplanController@edit')
    ->name('admin.healthplan.edit');
    Route::delete('/admin/healthplan/destroy/{healthplan}', 'App\Http\Controllers\HealthplanController@destroy')
    ->name('admin.healthplan.destroy');

    Route::get('/admin/patient', 'App\Http\Controllers\UserController@index')
    ->name('admin.patient');
    Route::post('/admin/patient/store', 'App\Http\Controllers\UserController@store')
    ->name('admin.patient.store');
    Route::post('/admin/patient/edit/{patient}', 'App\Http\Controllers\UserController@update')
    ->name('admin.patient.edit');
    Route::delete('/admin/patient/destroy/{patient}', 'App\Http\Controllers\UserController@destroy')
    ->name('admin.patient.destroy');

    Route::get('/admin/doctor', 'App\Http\Controllers\DoctorController@index')
    ->name('admin.doctor');
    Route::post('/admin/doctor/store', 'App\Http\Controllers\DoctorController@store')
    ->name('admin.doctor.store');
    Route::post('/admin/doctor/edit/{doctorid}', 'App\Http\Controllers\DoctorController@update')
    ->name('admin.doctor.edit');
    Route::delete('/admin/doctor/destroy/{doctorid}', 'App\Http\Controllers\DoctorController@destroy')
    ->name('admin.doctor.destroy');

    Route::get('/admin/send', 'App\Http\Controllers\SendController@index')
    ->name('send.index');
    Route::post('/admin/send', 'App\Http\Controllers\SendController@store')
    ->name('send.store');
});


Route::middleware('doctor')->group(function(){

    Route::get('/doctorDashboard', function () {
        return view('doctor.doctorDashboard');
    })->name('doctorDashboard');

    Route::get('/doctorlogout', function () {
        Auth::guard('doctor')->logout();

        return redirect('/');
    })->name('doctorlogout');

    Route::get('/doctor/profile', 'App\Http\Controllers\DoctorController@edit')
    ->name('doctor.profile');

    Route::post('/doctor/profileupdate/{doctorid}', 'App\Http\Controllers\DoctorController@update')
    ->name('doctor.profile.store');
    Route::post('/doctor/passwordupdate/{doctorid}', 'App\Http\Controllers\DoctorController@passwordupdate')
    ->name('doctor.update.password');


    Route::post('/doctor/profiledelete/{doctorid}', 'App\Http\Controllers\DoctorController@destroy')
    ->name('doctor.delete');

    Route::get('/doctor/mediacalreport', 'App\Http\Controllers\DoctorController@medicalreport')
    ->name('doctor.medicalreport');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
