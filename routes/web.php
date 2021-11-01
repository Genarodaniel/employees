<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/getZipCode',[App\Http\Controllers\ZipCodeController::class,'getAddress'])->name('getAddress');

// Route::get('*/getZipCode',[App\Http\Controllers\ZipCodeController::class,'getAddress'])->name('getAddress');

Auth::routes();

Route::get('/home', [
    HomeController::class, 'index'
])->name('home');


Route::resource('companies', App\Http\Controllers\CompanyController::class);

Route::resource('employees', App\Http\Controllers\EmployeeController::class);
