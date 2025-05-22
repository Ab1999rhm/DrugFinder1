<?php

use Illuminate\Support\Facades\Route;

// User Controllers
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDrugController;
use App\Http\Controllers\UserWishlistController;
use App\Http\Controllers\UserPharmacyController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\pub_UserPharmacyController;
// Seller Controllers
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\DrugController as SellerDrugController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\SellerProfileController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\Auth\RegisterController as SellerRegisterController;
use App\Http\Controllers\Seller\Auth\LoginController as SellerLoginController;
use App\Http\Controllers\Seller\Auth\ForgotPasswordController as SellerForgotPasswordController;
use App\Http\Controllers\Seller\Auth\ResetPasswordController as SellerResetPasswordController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\PublicDrugController;

// ============================
// Public Route
// ============================
Route::get('/', fn() => view('welcome'));
Route::get('/user/public_dashboard', function () {
    return view('user.public_dashboard');
})->name('user.public_dashboard');
Route::get('/user/drugs/public', [DrugController::class, 'publicIndex'])->name('user.drugs.public_index');



Route::get('/drugs', [PublicDrugController::class, 'index'])->name('drugs.index');



Route::get('/user/public_pharmacies', [pub_UserPharmacyController::class, 'publicPharmacies'])
    ->name('user.public_pharmacies');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// ============================
// User (Customer) Registration & Login
// ============================
Route::prefix('user')->name('user.')->group(function () {
    // Registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // Login/Logout
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ============================
// User Wishlist & Notifications (AJAX/Guest Access)
// ============================
Route::middleware('auth')->group(function () {
    Route::post('/user/wishlist', [UserWishlistController::class, 'store'])->name('user.wishlist.store');
    Route::post('/user/drugs/rate', [App\Http\Controllers\DrugController::class, 'rate'])->name('user.drugs.rate');
});

Route::get('/user/notifications', [UserNotificationController::class, 'index'])->name('user.notifications');

// ============================
// User Dashboard & Activities (Protected)
// ============================
Route::middleware(['auth', 'role:customer'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/drugs', [UserDrugController::class, 'index'])->name('drugs.index');
    Route::get('/drugs/autocomplete', [UserDrugController::class, 'autocomplete'])->name('drugs.autocomplete');
    Route::get('/drugs/{id}/details', [UserDrugController::class, 'details'])->name('drugs.details');
    Route::get('/drugs/{id}/compare', [UserDrugController::class, 'compare'])->name('drugs.compare');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/wishlist', [UserWishlistController::class, 'index'])->name('wishlist');
    Route::patch('/wishlist/{wishlist}', [UserWishlistController::class, 'update'])->name('wishlist.update');
    Route::delete('/wishlist/{wishlist}', [UserWishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/pharmacies', [UserPharmacyController::class, 'index'])->name('pharmacies');
    Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications');
    Route::get('/reviews', [UserReviewController::class, 'index'])->name('reviews');
});

// ============================
// Seller Registration & Login
// ============================
Route::prefix('seller')->name('seller.')->group(function () {
    // Registration
    Route::get('/register', [SellerRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [SellerRegisterController::class, 'register'])->name('register.submit');

    // Login/Logout
    Route::get('/login', [SellerLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SellerLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [SellerLoginController::class, 'logout'])->name('logout');

    // Password Reset
    Route::get('/password/reset', [SellerForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [SellerForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [SellerResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [SellerResetPasswordController::class, 'reset'])->name('password.update');

    // Protected Seller Routes
    Route::middleware('auth:seller')->group(function () {
        Route::get('/dashboard', [SellerController::class, 'index'])->name('dashboard');
        Route::get('/profile/edit', [SellerProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [SellerProfileController::class, 'update'])->name('profile.update');
        Route::resource('drugs', SellerDrugController::class);
        Route::post('/store/register', [StoreController::class, 'register'])->name('store.register');
        Route::get('/sales/history', [SellerController::class, 'salesHistory'])->name('sales.history');
        Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [SellerOrderController::class, 'update'])->name('orders.update');
        Route::get('/drugs/{drug}/orders', [SellerOrderController::class, 'ordersForDrug'])->name('drugs.orders');
    });
});

// ============================
// Admin Authentication Routes (OUTSIDE middleware group!)
// ============================
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login')
    ->middleware('guest:admin');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ============================
// Admin Dashboard & Management Routes (INSIDE middleware group!)
// ============================
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/sellers', [AdminDashboardController::class, 'sellers'])->name('sellers');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/pharmacies', [AdminDashboardController::class, 'pharmacies'])->name('pharmacies');
    Route::get('/drugs', [AdminDashboardController::class, 'drugs'])->name('drugs');
    Route::get('/orders', [AdminDashboardController::class, 'orders'])->name('orders');

    // User actions
    Route::patch('/users/{id}/approve', [AdminDashboardController::class, 'approveUser'])->name('users.approve');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'deleteUser'])->name('users.delete');

    // Seller actions
    Route::patch('/sellers/{id}/approve', [AdminDashboardController::class, 'approveSeller'])->name('sellers.approve');
    Route::get('/sellers/{id}/edit', [AdminDashboardController::class, 'editSeller'])->name('sellers.edit');
    Route::put('/sellers/{id}', [AdminDashboardController::class, 'updateSeller'])->name('sellers.update');
    Route::delete('/sellers/{id}', [AdminDashboardController::class, 'deleteSeller'])->name('sellers.delete');

    // Drug actions
    Route::delete('/drugs/{id}', [AdminDashboardController::class, 'deleteDrug'])->name('drugs.delete');






    // Sellers Management
    Route::get('/sellers/{id}/edit', [AdminDashboardController::class, 'editSeller'])->name('sellers.edit');
    Route::put('/sellers/{id}', [AdminDashboardController::class, 'updateSeller'])->name('sellers.update');
    Route::delete('/sellers/{id}', [AdminDashboardController::class, 'deleteSeller'])->name('sellers.delete');
});

// ============================
// Laravel Default Auth Routes (Optional)
// ============================
// require __DIR__.'/auth.php'; // Uncomment if using Laravel Breeze/Jetstream/etc.
