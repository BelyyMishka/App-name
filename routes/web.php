<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
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

/**
 *************************************** User routes
 */
Route::get("/", [\App\Http\Controllers\MainController::class, 'index'])->name('index');
Route::resource('posts', \App\Http\Controllers\PostController::class);
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/tag/{slug}', [\App\Http\Controllers\TagController::class, 'index'])->name('tag');

/**
 * Guest user
 */
Route::middleware(['guest'])->group(function () {

    /**
     * Authentication
     */
    Route::name('auth.')->group(function () {
        Route::get("/login", [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('loginForm');
        Route::post("/login", [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
        Route::get("/register", [\App\Http\Controllers\AuthController::class, 'registerForm'])->name('registerForm');
        Route::post("/register", [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    });

    /**
     * Forgot password
     */
    Route::get('/forgot', [ForgotController::class, 'forgotForm'])->name('forgotForm');
    Route::post('/forgot', [ForgotController::class, 'forgot'])->name('forgot');
    Route::get('/password/change/token/{token}', [ForgotController::class, 'newPasswordForm'])->name('newPasswordForm');
    Route::post('/password/change/token/{token}', [ForgotController::class, 'newPassword'])->name('newPassword');

    /**
     * Verify
     */
    Route::prefix('verify')->name('verify.')->group(function () {
        Route::get("/resend", [VerifyController::class, 'resendForm'])->name('resendForm');
        Route::post("/resend", [VerifyController::class, 'resend'])->name('resend');
        Route::get("/token/{token}", [VerifyController::class, 'verify'])->name('verify');
    });
});

/**
 * Auth user
 */
Route::middleware(['auth'])->group(function () {
    Route::get("/logout", [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

    /**
     * Profile
     */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('index');

        Route::get("/name", [UserController::class, 'changeNameForm'])->name('changeNameForm');
        Route::put("/name", [UserController::class, 'changeName'])->name('changeName');

        Route::get('/password', [UserController::class, 'changePasswordForm'])->name('changePasswordForm');
        Route::put('/password', [UserController::class, 'changePassword'])->name('changePassword');

        Route::get('/email', [UserController::class, 'changeEmailForm'])->name('changeEmailForm');
        Route::post('/email', [UserController::class, 'changeEmail'])->name('changeEmail');
        Route::middleware('code')->group(function () {
            Route::get('/email/token', [UserController::class, 'codeForm'])->name('codeForm');
            Route::put('/email/token', [UserController::class, 'code'])->name('code');
        });
    });
});



/**
 *************************************** Admin routes
 */
Route::prefix('admin')->name('admin.')->group(function () {

    /**
     * Auth admin
     */
    Route::middleware('auth:admin')->group(function () {
        Route::get("/", [MainController::class, 'index'])->name('index');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::get("/categories/list", [CategoryController::class, 'list'])->name('categories.list');

        Route::resource('tags', TagController::class)->except(['show']);
        Route::get("/tags/list", [TagController::class, 'list'])->name('tags.list');

        Route::resource('posts', PostController::class)->except(['show']);
        Route::get("/posts/list", [PostController::class, 'list'])->name('posts.list');

        Route::resource('admins', AdminController::class)->except(['show']);
        Route::get("/admins/list", [AdminController::class, 'list'])->name('admins.list');

        Route::get("/logout", [AuthController::class, 'logout'])->name('auth.logout');
    });

    /**
     * Guest admin
     */
    Route::middleware(['guest', 'guest:admin'])->group(function () {
        Route::get("/login", [AuthController::class, 'loginForm'])->name('auth.loginForm');
        Route::post("/login", [AuthController::class, 'login'])->name('auth.login');
    });
});
