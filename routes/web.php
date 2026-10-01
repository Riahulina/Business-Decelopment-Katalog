<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Support\Dummy;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ResellerProductController;
use App\Http\Controllers\ResellerProfileController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/produk/{slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/about', [AboutController::class, 'index'])
    ->name('about');

Route::get('/kolaborasi', [CollaborationController::class, 'index'])
    ->name('collaborations');
Route::view('/kontak', 'contact.index')->name('contact');
Route::get('/chatbot/faqs', [App\Http\Controllers\ChatbotController::class, 'index'])->name('chatbot.faqs');
Route::get('/chat', function () {
    return view('chatbot.index');
})->name('chatbot.page');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/produk', [App\Http\Controllers\ResellerProductController::class, 'index'])->name('reseller.products');
    Route::get('/dashboard/profil', [App\Http\Controllers\ResellerProfileController::class, 'edit'])->name('reseller.profile');
    Route::put('/dashboard/profil', [App\Http\Controllers\ResellerProfileController::class, 'update'])->name('reseller.profile.update');
    Route::get('/dashboard/products/create', [App\Http\Controllers\ResellerProductController::class, 'create'])->name('reseller.products.create');
    Route::post('/dashboard/products', [App\Http\Controllers\ResellerProductController::class, 'store'])->name('reseller.products.store');
});


require __DIR__ . '/auth.php';
