<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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
//authentication routes


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function(){

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('companies', CompanyController::class);
Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
// Resource routes for companies with 'home' prefix
Route::prefix('home')->group(function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});

});


Auth::routes();


