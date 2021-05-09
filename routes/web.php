<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/',
    [App\Http\Controllers\HomeController::class, 'index']
)->name('home');

Route::get('/companies',
    [App\Http\Controllers\CompanyController::class, 'getCompanies']
);

Route::group(['middleware'=>'auth'], function() {

    Route::post('/company/{company}/rate',
        [App\Http\Controllers\CompanyController::class, 'rateCompany']
    );

});

Route::group(['middleware'=>'admin', 'prefix' => 'admin'], function() {

    Route::apiResource('/companies', App\Http\Controllers\Admin\CompanyController::class);

});
