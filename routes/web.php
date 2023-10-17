<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;


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

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('signup',[UserController::class,'signup'])->name('signup');
Route::post('custom-signup',[UserController::class,'customsignup'])->name('custom-signup');
Route::get('login',[UserController::class,'login'])->name('login');
Route::post('custom-login',[UserController::class,'customlogin'])->name('custom-login');
Route::get('forget-password',[UserController::class,'forgetpassword'])->name('forget-password');
Route::post('forget-password',[UserController::class,'postforgetpassword'])->name('postforget-password');
Route::get('reset-password/{token}',[UserController::class,'getresetpassword'])->name('getreset-password');
Route::post('reset-password',[UserController::class,'postresetpassword'])->name('postreset-password');

Route::group(['middleware' => ['auth']], function(){
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::get('change-password',[UserController::class,'changepassword'])->name('change-password');
    Route::post('update-password',[UserController::class,'updatepassword'])->name('update-password');
    Route::prefix('account')->group(function(){
        Route::get('create',[AccountController::class,'addaccount'])->name('add-account');
        Route::post('store',[AccountController::class,'storeaccount'])->name('store-account');
        Route::get('list',[AccountController::class,'myaccounts'])->name('my-accounts');
        Route::get('edit/{id}',[AccountController::class,'editaccount'])->name('edit-account');
        Route::put('update/{id}',[AccountController::class,'updateaccount'])->name('update-account');
        Route::delete('delete/{id}',[AccountController::class,'deleteaccount'])->name('delete-account');
    });
    Route::prefix('transactions')->group(function(){
        Route::get('view/{id}',[TransactionController::class,'viewtransactions'])->name('view-transactions');
        Route::get('create',[TransactionController::class,'addtransactions'])->name('add-transactions');
        Route::post('store',[TransactionController::class,'storetransactions'])->name('store-transactions');
        Route::get('edit/{id}',[TransactionController::class,'edittransactions'])->name('edit-transactions');
        Route::put('update/{id}',[TransactionController::class,'updatetransactions'])->name('update-transactions');
        Route::delete('delete/{id}',[TransactionController::class,'deletetransactions'])->name('delete-transactions');
    });
    Route::prefix('othersaccount')->group(function(){
        Route::get('add',[AccountController::class,'addothersaccount'])->name('add-othersaccount');
        Route::get('search',[AccountController::class,'searchothersaccount'])->name('search-othersaccount');
        Route::delete('delete/{id}',[AccountController::class,'deleteothersaccount'])->name('delete-othersaccount');
    });
    Route::prefix('request')->group(function(){
        Route::get('send/{id}',[AccountController::class,'sendrequest'])->name('send-request');
        Route::get('view',[AccountController::class,'viewrequests'])->name('view-requests');
        Route::get('approve/{id}',[AccountController::class,'approverequest'])->name('approve-request');
    });
    Route::post('account-search',[TransactionController::class,'accountsearch'])->name('account-search');
});
