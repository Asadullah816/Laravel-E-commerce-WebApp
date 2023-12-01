<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/home', function () {
//     return view('index');
// });
Route::get('allproducts', [HomeController::class, 'allproduct'])->name('allproduct');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->middleware('verified')->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('carts', [HomeController::class, 'cartItem']);
    // Route::view('productDetail', 'home.productDetail');
    Route::get('productDetail/{id}', [HomeController::class, 'productDetail'])->name('productDetail');
    Route::post('addtocart/{id}', [HomeController::class, 'addToCart'])->name('addToCart');
    // Route::view('cart', 'home.cartItems');
    Route::get('cart', [HomeController::class, 'cartShow'])->name('cart');
    // Route::get('/', [HomeController::class, 'cartItems']);
    Route::get('deleteCart/{id}', [HomeController::class, 'deleteCart'])->name('deleteCart');
    Route::get('order', [HomeController::class, 'order'])->name('order');
    Route::get('stripe/{total}', [HomeController::class, 'stripe'])->name('stripe');
    Route::get('sendemail/{id}', [AdminController::class, 'send_email'])->name('sendemail');
    Route::get('userorder', [HomeController::class, 'order_detail'])->name('userorders');
    Route::get('addtocartagain/{id}', [HomeController::class, 'cancel_order'])->name('cancelorder');
    Route::post('cancelOrder/{id}', [HomeController::class, 'cancel_order'])->name('addtocartagain');
    Route::post('comment/{id}', [HomeController::class, 'comments'])->name('comment');
    Route::post('reply/{id}', [HomeController::class, 'reply'])->name('reply');
    // ==========================================
    // ===============              =============
    // =============== ADMIN ROUTES =============
    // ===============              =============
    // ==========================================
    Route::prefix('dashboard')->middleware('admin')->group(function () {
        Route::get('home', [AdminController::class, 'admindata'])->name('dashboard');
        Route::get('viewAddCategory', [AdminController::class, 'showCategory'])->name('addCategory');
        Route::post('add_category', [AdminController::class, 'addCategory']);
        Route::get('deleteCategory/{id}', [AdminController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('addproduct', [AdminController::class, 'addproduct'])->name('addproduct');
        Route::post('addnewproduct', [AdminController::class, 'addnewProduct']);
        Route::get('showProduct', [AdminController::class, 'showProduct'])->name('showproduct');
        Route::get('productDelete/{id}', [AdminController::class, 'productDelete'])->name('productDelete');
        Route::get('updateproductdata/{id}', [AdminController::class, 'showUpdateData'])->name('updateProduct');
        Route::post('updateproduct/{id}', [AdminController::class, 'updateProduct']);
        // Route::get('stripe', 'stripe/{total}');
        Route::post('stripe', [HomeController::class, 'stripePost'])->name('stripe.post');
        Route::get('orders', [AdminController::class, 'ShowOrders'])->name('orders');
        Route::get('deliverd/{id}', [AdminController::class, 'deliverd'])->name('deliverd');
        Route::get('download_pdf/{id}', [AdminController::class, 'download_pdf'])->name('download_pdf');
        Route::get('adminsearch', [AdminController::class, 'adminsearch'])->name('adminsearch');
    });
});
require __DIR__ . '/auth.php';
