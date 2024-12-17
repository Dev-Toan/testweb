<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\ArticleDetailController;
use App\Http\Controllers\Frontend\BlogBaseController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\ProductTypeController;
use App\Http\Controllers\Frontend\ShoppingCartController;
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

// Route::get('/', function () {
//     // return view('welcome');
//     dd(app());
// });

Route::get('register', [RegisterController::class, 'getFormRegister'])->name('get.register');
Route::post('register', [RegisterController::class, 'postRegister']);
Route::get('verify/{id}', [RegisterController::class, 'verifyEmail'])->name('get.verifyemail')->middleware('signed');

Route::get('reset-verify', [RegisterController::class, 'resetVerifyEmail'])->name('get.reset.verifyemail');

Route::get('login', [LoginController::class, 'getFormLogin'])->name('get.login')->middleware('guest');
Route::post('login', [LoginController::class, 'postLogin'])->middleware('guest');

Route::get('logout', [LoginController::class, 'getLogout'])->name('get.logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'getFormForgot'])->name('get.FormForgot');
Route::post('forgot-password', [ForgotPasswordController::class, 'postForgot'])->name('post.postForgot');
Route::get('forgot-change-password', [ForgotPasswordController::class, 'getChangeForgotPassword'])->name('get.ChangeForgotPassword');
Route::post('forgot-change-password', [ForgotPasswordController::class, 'postChangeForgotPassword'])->name('post.ChangeForgotPassword');

Route::get('auth/google/url', [GoogleController::class, 'loginUrl'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'loginCallback'])->name('login.google.callback');

Route::get('/', [HomeController::class, 'index'])->name('get.home');
Route::get('search', [HomeController::class, 'search'])->name('get.search');
Route::get('danh-muc/{slug}', [CategoryController::class, 'index'])->name('get.category.list');
Route::get('type/{slug}', [ProductTypeController::class, 'index'])->name('get.type.product.list');
Route::get('san-pham/{slug}', [ProductDetailController::class, 'index'])->name('get.product.detail');

Route::get('san-pham/{slug}/danh-gia', [ProductDetailController::class, 'getListRatingProduct'])->name('get.product.rating_list');

Route::get('bai-viet', [BlogBaseController::class, 'getIndex'])->name('get.article.index');
Route::get('bai-viet/{slug}', [BlogController::class, 'index'])->name('get.blog.index');
Route::get('article/{slug}', [ArticleDetailController::class, 'index'])->name('get.article.detail.index');

//giohang
Route::get('don-hang', [ShoppingCartController::class, 'index'])->name('get.shopping.list');
Route::get('success', [ShoppingCartController::class, 'success'])->name('get.success.list');
Route::get('delete_all_shopping', [ShoppingCartController::class, 'delete_all_shopping'])->name('get.delete_all_shopping.list');
Route::group(['prefix' => 'shopping'], function () {
    Route::get('add/{id}', [ShoppingCartController::class, 'add'])->name('get.shopping.add');
    Route::get('delete/{id}', [ShoppingCartController::class, 'delete'])->name('get.shopping.delete');
    Route::get('update/{id}', [ShoppingCartController::class, 'update'])->name('ajax_get.shopping.update');
    Route::post('pay', [ShoppingCartController::class, 'postPay'])->name('post.shopping.pay');
    Route::post('payment/online', [ShoppingCartController::class, 'createPayment'])->name('shopping.payment.online.create');
    Route::get('payment/online/return', [ShoppingCartController::class, 'vnpayReturn'])->name('shopping.payment.online.return');
});

include 'admin.php';
include 'user.php';

