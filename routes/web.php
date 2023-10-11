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
Route::post('customsignup',[UserController::class,'customsignup'])->name('custom-signup');
Route::get('login',[UserController::class,'login'])->name('login');
Route::post('customlogin',[UserController::class,'customlogin'])->name('custom-login');
Route::get('forgetpassword',[UserController::class,'forgetpassword'])->name('forget-password');
Route::post('forgetpassword',[UserController::class,'postforgetpassword'])->name('postforget-password');
Route::get('resetpassword/{token}',[UserController::class,'getresetpassword'])->name('getreset-password');
Route::post('resetpassword',[UserController::class,'postresetpassword'])->name('postreset-password');

Route::group(['middleware' => ['auth']], function(){
    Route::get('logout',[UserController::class,'logout'])->name('logout');
    Route::get('changepassword',[UserController::class,'changepassword'])->name('change-password');
    Route::post('updatepassword',[UserController::class,'updatepassword'])->name('update-password');
    Route::prefix('account')->group(function(){
        Route::get('addaccount',[AccountController::class,'addaccount'])->name('add-account');
        Route::post('storeaccount',[AccountController::class,'storeaccount'])->name('store-account');
        Route::get('myaccounts',[AccountController::class,'myaccounts'])->name('my-accounts');
        Route::get('editaccount/{id}',[AccountController::class,'editaccount'])->name('edit-account');
        Route::put('updateaccount/{id}',[AccountController::class,'updateaccount'])->name('update-account');
        Route::delete('deleteaccount/{id}',[AccountController::class,'deleteaccount'])->name('delete-account');
    });
    Route::prefix('transactions')->group(function(){
        Route::get('viewtransactions/{id}',[TransactionController::class,'viewtransactions'])->name('view-transactions');
        Route::get('addtransactions',[TransactionController::class,'addtransactions'])->name('add-transactions');
        Route::post('storetransactions',[TransactionController::class,'storetransactions'])->name('store-transactions');
        Route::get('edittransactions/{id}',[TransactionController::class,'edittransactions'])->name('edit-transactions');
        Route::put('updatetransactions/{id}',[TransactionController::class,'updatetransactions'])->name('update-transactions');
        Route::delete('deletetransactions/{id}',[TransactionController::class,'deletetransactions'])->name('delete-transactions');
    });
    Route::post('accountsearch',[TransactionController::class,'accountsearch'])->name('account-search');
    Route::get('addothersaccount',[AccountController::class,'addothersaccount'])->name('add-othersaccount');
    Route::get('searchothersaccount',[AccountController::class,'searchothersaccount'])->name('search-othersaccount');
    Route::get('sendrequest/{id}',[AccountController::class,'sendrequest'])->name('send-request');
    Route::get('viewrequests',[AccountController::class,'viewrequests'])->name('view-requests');
    Route::get('approverequest/{id}',[AccountController::class,'approverequest'])->name('approve-request');
});
