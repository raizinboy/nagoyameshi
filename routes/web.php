<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyInformationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;

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

Route::get('/', [WebController::class, 'index'])->name('top');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
    Route::get('users/payment_method', 'getPaymentMethod')->name('mypage.getPaymentMethod');
    Route::post('users/payment_method', 'postPaymentMethod')->name('mypage.postPaymentMethod');
    Route::post('users/payment_method/cancel', 'cancelsubscription')->name('subscription.cancel');
    Route::post('users/payment_method/resume', 'resumesubscription')->name('subscription.resume');
});

Route::controller(ReservationController::class)->group(function (){
    Route::post('shops/show/reservation', 'store')->name('reservation.store');
    Route::get('users/reservation', 'show')->name('reservation.show');
    Route::delete('users/reservation/delete', 'destroy')->name('reservation.destroy');
});

Route::get('shops/{shop}/favorite', [ShopController::class, 'favorite'])->name('shops.favorite');

Route::resource('shops', ShopController::class)->middleware(['auth', 'verified']);

Route::post('reviews', [ReviewController::class, 'store'])->name('review.store');

Route::get('companyinformations', [CompanyInformationController::class, 'index'])->name('companyinformation.index');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
