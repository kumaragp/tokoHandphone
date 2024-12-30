<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminPerusahaan;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name("home");
Route::get('/product/{id}', [HomeController::class, 'show'])->name("product");

Route::post('/checkout', [CheckoutController::class, 'process'])->name("checkout-process");
Route::get('/checkout/{transaction}', [CheckoutController::class, 'checkout'])->name("checkout");
Route::get('/checkout/success/{transaction}',[CheckoutController::class,'success'])->name('checkout-success');

Route::get('/transactions', [TransactionController::class, 'index'])->name("transactions");

route::middleware(['auth','admin'])->group(function (){
    Route::controller(AdminPerusahaan::class)->prefix('admin')->group(function(){
        Route::get('', 'perusahaan')->name('admin');
    });
    Route::resource("/admin/products", ProductController::class);
    Route::post("/admin/products", [ProductController::class,"store"])->name("products.store");
    Route::post("/admin/products/delete", [ProductController::class,"deleteArray"]);
    Route::post("/admin/products/update", [ProductController::class,"update"]);
});
Route::get('dashboard',function(){
    return view('dashboard');
})->name('dashboard');
Auth::routes();
