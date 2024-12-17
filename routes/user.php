<?php

use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserFavouriteController;
use App\Http\Controllers\User\UserInfoController;
use App\Http\Controllers\User\UserRatingController;
use App\Http\Controllers\User\UserTransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    Route::get('/', [UserDashboardController::class, 'dashboard'])->name('get.user.dashboard');

    Route::get('update-info', [UserInfoController::class, 'updateInfo'])->name('get.user.update_info');
    Route::post('update-info', [UserInfoController::class, 'saveUpdateInfo'])->name('post.user.update_info');
    Route::get('change-password', [UserInfoController::class, 'getChangePassword'])->name('get.user.change.password');
    Route::post('change-password', [UserInfoController::class, 'postChangePassword']);

    Route::get('transaction', [UserTransactionController::class, 'index'])->name('get.user.transaction');
    Route::get('transaction-detail/{id}', [UserTransactionController::class, 'detail'])->name('get.user.transaction.detail');

    Route::get('favourite', [UserFavouriteController::class, 'index'])->name('get.user.favourite');
    Route::post('ajax-favourite/{id}', [UserFavouriteController::class, 'addFavourite'])->name('ajax_get.user.add');

    Route::post('ajax-rating', [UserRatingController::class, 'addRatingProduct'])->name('ajax_post.user.rating.add');
});
