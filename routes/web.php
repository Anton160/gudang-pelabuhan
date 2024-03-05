<?php

use App\Models\User;
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
Route::middleware('banned')->group(function () {

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::post('/Tax/input',[\App\Http\Controllers\TaxInput::class,'taxInput'])->middleware('auth');
Route::get('/Tax/input',[\App\Http\Controllers\TaxInput::class,'taxView'])->middleware('auth');
Route::get('/Tax/Download',[\App\Http\Controllers\TaxInput::class,'download'])->middleware('auth');

Route::post('/Rent/input',[\App\Http\Controllers\RentInput::class,'rentInput'])->middleware('auth');
Route::get('/Rent/input',[\App\Http\Controllers\RentInput::class,'rentView'])->middleware('auth');
Route::get('/Rent/Download',[\App\Http\Controllers\RentInput::class,'download'])->middleware('auth');

Route::post('/Salary/input',[\App\Http\Controllers\SalaryInput::class,'salaryInput'])->middleware('auth');
Route::get('/Salary/input',[\App\Http\Controllers\SalaryInput::class,'salaryView'])->middleware('auth');
Route::get('/Salary/Download',[\App\Http\Controllers\SalaryInput::class,'download'])->middleware('auth');

Route::post('/Other/input',[\App\Http\Controllers\Other_costs::class,'otherInput'])->middleware('auth');
Route::get('/Other/input',[\App\Http\Controllers\Other_costs::class,'otherView'])->middleware('auth');
Route::get('/Other/Download',[\App\Http\Controllers\Other_costs::class,'download'])->middleware('auth');

Route::post('/Compensation/input',[\App\Http\Controllers\compensationInput::class,'conpensationInput'])->middleware('auth');
Route::get('/Compensation/input',[\App\Http\Controllers\compensationInput::class,'conpensationView'])->middleware('auth');
Route::get('/Compensation/Download',[\App\Http\Controllers\compensationInput::class,'download'])->middleware('auth');

Route::post('/Debt/input',[\App\Http\Controllers\DebtInput::class,'debtInput'])->middleware('auth');
Route::get('/Debt/input',[\App\Http\Controllers\DebtInput::class,'debtView'])->middleware('auth');
Route::get('/Debt/Download',[\App\Http\Controllers\DebtInput::class,'download'])->middleware('auth');

Route::post('/DebtPay/input',[\App\Http\Controllers\DebtPaymentInput::class,'debtInput'])->middleware('auth');
Route::get('/DebtPay/input',[\App\Http\Controllers\DebtPaymentInput::class,'debtView'])->middleware('auth');
Route::get('/DebtPay/Download',[\App\Http\Controllers\DebtPaymentInput::class,'download'])->middleware('auth');

Route::get('/user-account',[\App\Http\Controllers\UserAccount::class,'index'])->middleware('auth');
Route::get('/user-account/create',[\App\Http\Controllers\UserAccount::class,'create'])->middleware('auth');
Route::post('/user-account',[\App\Http\Controllers\UserAccount::class,'store'])->middleware('auth');
Route::get('/user-account/edit/{user}',[\App\Http\Controllers\UserAccount::class,'edit'])->middleware('auth');
Route::delete('/userdelete/{user}',[\App\Http\Controllers\UserAccount::class,'destroy'])->middleware('auth');
Route::put('/user-account/{user}',[\App\Http\Controllers\UserAccount::class,'update'])->middleware('auth');
});
Route::get('/', function () {
    return view('dashboard',[
        'users' =>User::where('id',auth()->user()->id)->first()
    ]);

})->middleware('redirect');
Route::get('/userLogin',[\App\Http\Controllers\UserLogin::class,'UserAccount'])->middleware('guest')->name('login')->withoutMiddleware('auth');
Route::post('/userLogin',[\App\Http\Controllers\UserLogin::class,'Authenticate']);
Route::get('/logout',[\App\Http\Controllers\UserLogin::class,'logout']);


