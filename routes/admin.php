<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminAttributeController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRatingController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\AdminStatisticalController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminTypeProductController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin-auth'], function () {
    Route::get('login', [AdminLoginController::class, 'index'])->middleware('guest');
    Route::post('login', [AdminLoginController::class, 'postLoginAdmin'])->name('post.login.admin')->middleware('guest');
    Route::get('logout', [AdminLoginController::class, 'getLogoutAdmin'])->name('get.logout.admin');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'check_role:' . config('contants.ROLE.ADMIN')]], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::middleware(['auth', 'check_role:' . config('contants.ROLE.ADMIN')])->group(function () {
    Route::group(['prefix' => 'admin-datn'], function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
        Route::get('ajax-read-notify/{id}', [AdminHomeController::class, 'readNotify'])->name('ajax.read.notify');
        
        
        
        
        // Route::get('ajax-read-notify-all', [AdminHomeController::class, 'readNotifyAll'])->name('ajax.read.notify.all');

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
            Route::post('create', [AdminCategoryController::class, 'store'])->name('admin.category.store');

            Route::get('update/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
            Route::post('update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');

            Route::get('delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
            Route::get('active/{id}', [AdminCategoryController::class, 'active'])->name('admin.category.active');
            Route::get('hot/{id}', [AdminCategoryController::class, 'hot'])->name('admin.category.hot');
            // Route::get('ajax-search-table',[AdminCategoryController::class,'ajax_search_table'])->name('ajax.admin.category.search');
        });

        Route::group(['prefix' => 'type-product'], function () {
            Route::get('/', [AdminTypeProductController::class, 'index'])->name('admin.typeproduct.index');
            Route::get('create', [AdminTypeProductController::class, 'create'])->name('admin.typeproduct.create');
            Route::post('create', [AdminTypeProductController::class, 'store'])->name('admin.typeproduct.store');

            Route::get('update/{id}', [AdminTypeProductController::class, 'edit'])->name('admin.typeproduct.edit');
            Route::post('update/{id}', [AdminTypeProductController::class, 'update'])->name('admin.typeproduct.update');

            Route::get('delete/{id}', [AdminTypeProductController::class, 'delete'])->name('admin.typeproduct.delete');
            Route::get('active/{id}', [AdminTypeProductController::class, 'active'])->name('admin.typeproduct.active');
            Route::get('hot/{id}', [AdminTypeProductController::class, 'hot'])->name('admin.typeproduct.hot');
        });

        Route::group(['prefix' => 'attribute'], function () {
            Route::get('/', [AdminAttributeController::class, 'index'])->name('admin.attribute.index');
            Route::get('create', [AdminAttributeController::class, 'create'])->name('admin.attribute.create');
            Route::post('create', [AdminAttributeController::class, 'store'])->name('admin.attribute.store');

            Route::get('update/{id}', [AdminAttributeController::class, 'edit'])->name('admin.attribute.edit');
            Route::post('update/{id}', [AdminAttributeController::class, 'update']);

            Route::get('delete/{id}', [AdminAttributeController::class, 'delete'])->name('admin.attribute.delete');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
            Route::get('create', [AdminProductController::class, 'create'])->name('admin.product.create');
            Route::post('create', [AdminProductController::class, 'store'])->name('admin.product.store');

            Route::get('update/{id}', [AdminProductController::class, 'edit'])->name('admin.product.edit');
            Route::post('update/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');

            Route::get('delete/{id}', [AdminProductController::class, 'delete'])->name('admin.product.delete');
            Route::get('active/{id}', [AdminProductController::class, 'active'])->name('admin.product.active');
            Route::get('hot/{id}', [AdminProductController::class, 'hot'])->name('admin.product.hot');

            Route::get('delete-image/{id}', [AdminProductController::class, 'deleteImage'])->name('admin.product.delete_image');
            Route::get('get-type-product/{categoryId?}', [AdminProductController::class, 'getTypeProduct'])->name('admin.product.get.typeproduct');
        });

        Route::group(['prefix' => 'slide'], function () {
            Route::get('/', [AdminSlideController::class, 'index'])->name('admin.slide.index');
            Route::get('create', [AdminSlideController::class, 'create'])->name('admin.slide.create');
            Route::post('create', [AdminSlideController::class, 'store'])->name('admin.slide.store');

            Route::get('update/{id}', [AdminSlideController::class, 'edit'])->name('admin.slide.edit');
            Route::post('update/{id}', [AdminSlideController::class, 'update'])->name('admin.slide.update');

            Route::get('delete/{id}', [AdminSlideController::class, 'delete'])->name('admin.slide.delete');
            Route::get('active/{id}', [AdminSlideController::class, 'active'])->name('admin.slide.active');

            Route::get('delete-image/{id}', [AdminSlideController::class, 'deleteImage'])->name('admin.slide.delete_image');
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', [AdminMenuController::class, 'index'])->name('admin.menu.index');
            Route::get('create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
            Route::post('create', [AdminMenuController::class, 'store']);

            Route::get('update/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.update');
            Route::post('update/{id}', [AdminMenuController::class, 'update']);

            Route::get('delete/{id}', [AdminMenuController::class, 'delete'])->name('admin.menu.delete');
            Route::get('active/{id}', [AdminMenuController::class, 'active'])->name('admin.menu.active');

            Route::get('hot/{id}', [AdminMenuController::class, 'hot'])->name('admin.menu.hot');
        });

        Route::group(['prefix' => 'article'], function () {
            Route::get('/', [AdminArticleController::class, 'index'])->name('admin.article.index');
            Route::get('create', [AdminArticleController::class, 'create'])->name('admin.article.create');
            Route::post('create', [AdminArticleController::class, 'store']);

            Route::get('update/{id}', [AdminArticleController::class, 'edit'])->name('admin.article.update');
            Route::post('update/{id}', [AdminArticleController::class, 'update']);

            Route::get('delete/{id}', [AdminArticleController::class, 'delete'])->name('admin.article.delete');
            Route::get('active/{id}', [AdminArticleController::class, 'active'])->name('admin.article.active');

            Route::get('hot/{id}', [AdminArticleController::class, 'hot'])->name('admin.article.hot');
        });

        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/', [AdminTransactionController::class, 'index'])->name('admin.transaction.index');
            Route::get('delete/{id}', [AdminTransactionController::class, 'delete'])->name('admin.transaction.delete');
            Route::get('view/{id}', [AdminTransactionController::class, 'getTransactionDetail'])->name('admin.transaction.detail');
            Route::get('order-delete/{id}', [AdminTransactionController::class, 'order_detail_delete'])->name('admin.order_detail.delete');
            Route::get('action/{action}/{id}', [AdminTransactionController::class, 'getAction'])->name('admin.transaction.action');
        });

        Route::group(['prefix' => 'rating'], function () {
            Route::get('/', [AdminRatingController::class, 'index'])->name('admin.rating.index');
            Route::get('active/{id}', [AdminRatingController::class, 'active'])->name('admin.rating.active');
            Route::get('delete/{id}', [AdminRatingController::class, 'delete'])->name('admin.rating.delete');
            Route::get('view_detail/{id}', [AdminRatingController::class, 'viewDetail'])->name('admin.ajax.view.detail.rating');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
            Route::get('update/{id}', [AdminUserController::class, 'edit'])->name('admin.user.update');
            Route::post('update/{id}', [AdminUserController::class, 'update']);
            Route::get('delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
        });

        Route::group(['prefix' => 'statistical'], function () {
            Route::get('/', [AdminStatisticalController::class, 'index'])->name('admin.statistical.index');
        });
    });
});
