<?php

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
    return view('dashboard');
});
Route::post('/Tax/input',[\App\Http\Controllers\TaxInput::class,'taxInput']);
Route::get('/Tax/input',[\App\Http\Controllers\TaxInput::class,'taxView']);
Route::get('/Tax/Download',[\App\Http\Controllers\TaxInput::class,'download']);

Route::post('/Rent/input',[\App\Http\Controllers\RentInput::class,'rentInput']);
Route::get('/Rent/input',[\App\Http\Controllers\RentInput::class,'rentView']);
Route::get('/Rent/Download',[\App\Http\Controllers\RentInput::class,'download']);

Route::post('/Salary/input',[\App\Http\Controllers\SalaryInput::class,'salaryInput']);
Route::get('/Salary/input',[\App\Http\Controllers\SalaryInput::class,'salaryView']);
Route::get('/Salary/Download',[\App\Http\Controllers\SalaryInput::class,'download']);

Route::post('/Other/input',[\App\Http\Controllers\Other_costs::class,'otherInput']);
Route::get('/Other/input',[\App\Http\Controllers\Other_costs::class,'otherView']);
Route::get('/Other/Download',[\App\Http\Controllers\Other_costs::class,'download']);

Route::post('/Compensation/input',[\App\Http\Controllers\compensationInput::class,'conpensationInput']);
Route::get('/Compensation/input',[\App\Http\Controllers\compensationInput::class,'conpensationView']);
Route::get('/Compensation/Download',[\App\Http\Controllers\compensationInput::class,'download']);

Route::post('/Debt/input',[\App\Http\Controllers\DebtInput::class,'debtInput']);
Route::get('/Debt/input',[\App\Http\Controllers\DebtInput::class,'debtView']);
Route::get('/Debt/Download',[\App\Http\Controllers\DebtInput::class,'download']);

Route::post('/DebtPay/input',[\App\Http\Controllers\DebtPaymentInput::class,'debtInput']);
Route::get('/DebtPay/input',[\App\Http\Controllers\DebtPaymentInput::class,'debtView']);
Route::get('/DebtPay/Download',[\App\Http\Controllers\DebtPaymentInput::class,'download']);


