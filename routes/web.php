<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ClientProductController;
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

Route::controller(HomeController::class)->group(function () {
  Route::get('/', 'index');
  Route::get('/about', 'about')->name('client.about');
  Route::post('/subscribe', 'subscribe')->name('client.subscribe');
});

Route::controller(ClientProductController::class)->group(function () {
  Route::prefix('products')->group(function () {
    Route::get('/', 'index')->name('client.products.index');
    Route::get('/{id}/{slug}', 'show')->name('client.products.show');
    Route::get('/search', 'search')->name('client.products.search');
    Route::post('/product/comment/{id}', 'postComment')->middleware('auth')->name('client.products.comment');
  });
});

Route::controller(CartController::class)->group(function () {
  Route::prefix('cart')->group(function () {
    Route::get('/', 'index')->name('client.cart.index');
    Route::post('/add/{id}', 'add')->name('client.cart.add');
    Route::post('/update/{rowId}', 'update')->name('client.cart.update');
    Route::get('/removeItem/{rowId}', 'remove')->name('client.cart.remove');
  });
});

Route::controller(CheckoutController::class)->group(function () {
  Route::prefix('checkout')->group(function () {
    Route::get('/', 'index')->name('client.checkout.index');
    Route::post('/', 'checkout')->name('client.checkout.post');
    Route::get('/vnPayCheck', 'vnPayCheck');
  });
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
  Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::controller(UserController::class)->group(function () {
      Route::prefix('users')->group(function () {
        Route::get('/', 'index')->name('admin.users.index');
        Route::get('/create', 'create')->name('admin.users.create');
        Route::post('/create', 'store')->name('admin.users.store');
        Route::get('/edit/{id}', 'edit')->name('admin.users.edit');
        Route::put('/update/{id}', 'update')->name('admin.users.update');
        Route::patch('/lock/{id}', 'lock')->name('admin.users.lock');
        Route::delete('/delete/{id}', 'destroy')->name('admin.users.delete');
      });
    });
    Route::controller(BrandController::class)->group(function () {
      Route::prefix('brands')->group(function () {
        Route::get('/', 'index')->name('admin.brands.index');
        Route::get('/create', 'create')->name('admin.brands.create');
        Route::post('/create', 'store')->name('admin.brands.store');
        Route::get('/edit/{id}/{slug}', 'edit')->name('admin.brands.edit');
        Route::put('/update/{id}', 'update')->name('admin.brands.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.brands.delete');
      });
    });
    Route::controller(ProductCategoryController::class)->group(function () {
      Route::prefix('product_cates')->group(function () {
        Route::get('/', 'index')->name('admin.product_cates.index');
        Route::get('/create', 'create')->name('admin.product_cates.create');
        Route::post('/create', 'store')->name('admin.product_cates.store');
        Route::get('/edit/{id}/{slug}', 'edit')->name('admin.product_cates.edit');
        Route::put('/update/{id}', 'update')->name('admin.product_cates.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.product_cates.delete');
      });
    });
    Route::controller(ProductController::class)->group(function () {
      Route::prefix('products')->group(function () {
        Route::get('/', 'index')->name('admin.products.index');
        Route::get('/create', 'create')->name('admin.products.create');
        Route::post('/create', 'store')->name('admin.products.store');
        Route::get('/edit/{id}', 'edit')->name('admin.products.edit');
        Route::put('/update/{id}', 'update')->name('admin.products.update');
        Route::delete('/delete/{id}', 'destroy')->name('admin.products.delete');
      });
    });
    Route::controller(OrderController::class)->group(function () {
      Route::prefix('orders')->group(function () {
        Route::get('/', 'index')->name('admin.orders.index');
        Route::get('/show/{id}', 'show')->name('admin.orders.show');
      });
    });
  });
});

Route::prefix('auth')->group(function () {
  Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
  Route::post('/login', [AuthController::class, 'loginPost'])->name('auth.login.post');
  Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
  Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup');
  Route::post('/signup', [AuthController::class, 'signupPost'])->name('auth.signup.post');

  Route::controller(SocialController::class)->group(function () {
    Route::prefix('google')->group(function () {
      Route::get('/', 'google')->name('auth.google.index');
      Route::get('/callback', 'googleCallback');
    });
  });
});

Route::fallback(function () {
  abort(404);
});
