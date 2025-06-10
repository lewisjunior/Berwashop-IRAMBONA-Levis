<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ShopkeeperAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [ShopkeeperAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ShopkeeperAuthController::class, 'login']);
Route::get('/register', [ShopkeeperAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [ShopkeeperAuthController::class, 'register']);
Route::get('/logout/confirm', [ShopkeeperAuthController::class, 'logoutConfirmation'])->name('logout.confirm')->middleware('auth');
Route::post('/logout', [ShopkeeperAuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('products.index');
    })->name('dashboard');
    
    Route::resource('products', ProductController::class);

    // Stock Management Routes
    Route::get('/stock/in', [StockController::class, 'stockIn'])->name('stock.in');
    Route::post('/stock/in', [StockController::class, 'storeStockIn'])->name('stock.in.store');
    Route::get('/stock/out', [StockController::class, 'stockOut'])->name('stock.out');
    Route::post('/stock/out', [StockController::class, 'storeStockOut'])->name('stock.out.store');
    Route::get('/stock/report', [StockController::class, 'report'])->name('stock.report');
});
