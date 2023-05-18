<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\FrontController;
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
Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('/view-product/{id}', [FrontController::class, 'viewProduct'])->name('view-product');
Route::get('/man-store', [FrontController::class, 'manStore'])->name('man-store');
Route::get('/woman-store', [FrontController::class, 'womanStore'])->name('woman-store');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/user-orders', [FrontController::class, 'userOrders'])->name('user-orders');
Route::delete('/order-details-delete/{id}', [FrontController::class, 'deleteDetailsFromOrder'])->name('order-details-delete');
Route::post('/add-delete-form-cart',[FrontController::class, 'addAndDeleteFromCart']);
Route::post('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/user-update-profile', [FrontController::class, 'userUpdateProfile'])->name('user-update-profile');
Route::get('/edit-profile', [FrontController::class, 'userUpdateProfilePage'])->name('edit-profile');
Route::get('/user-login',function () {
    return view('front.login');
})->name('user-login');
Route::get('/user-register',function () {
    return view('front.register');
})->name('user-register');
Route::post('addToCart', [FrontController::class, 'addToCart']);
Route::get('/admin', function () {
    return view('auth.login');
});

Route::post('/user-register', [FrontController::class, 'register'])->name('user-register');
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'manage'])->name('dashboard');

    Route::prefix('users')->as('users.')->group(function() {
        Route::get('/manage', [UsersController::class, 'manage'])->name('manage');
        Route::get('/datatable', [UsersController::class, 'datatable'])->name('datatable');
        Route::post('/image-add', [UsersController::class, 'addImage'])->name('image_add');
        Route::delete('/image-remove/{id}', [UsersController::class, 'removeImage'])->name('image_remove');
    });
    Route::resource('users', UsersController::class);

    Route::prefix('products')->as('products.')->group(function() {
        Route::get('/manage', [ProductsController::class, 'manage'])->name('manage');
        Route::get('/datatable', [ProductsController::class, 'datatable'])->name('datatable');
        Route::post('/image-add', [ProductsController::class, 'addImage'])->name('image_add');
        Route::delete('/image-remove/{id}', [ProductsController::class, 'removeImage'])->name('image_remove');
    });
    Route::resource('products', ProductsController::class);

    Route::prefix('orders')->as('orders.')->group(function() {
        Route::get('/manage', [ProductsController::class, 'manageOrders'])->name('manage');
        Route::delete('/delete-order/{id}', [ProductsController::class, 'deleteOrder'])->name('delete-order');
    });

    require __DIR__.'/auth.php';
});

