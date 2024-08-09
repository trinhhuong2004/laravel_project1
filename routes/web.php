<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\manageOrderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Client\MainController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use App\Http\Controllers\CartController;
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
// clients
Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/gioi-thieu', [MainController::class, 'about'])->name('about');
Route::get('/lien-he', [MainController::class, 'contact'])->name('contact');
Route::get('/tin-tuc', [MainController::class, 'posts'])->name('news');

Route::get('/dang-nhap', [MainController::class, 'login'])->name('login');
Route::get('/dang-ky', [MainController::class, 'register'])->name('register');


Route::get('/danh-sach-san-pham', [MainController::class, 'products'])->name('products.list');
Route::get('/san-pham-chi-tiet/{slug}', [MainController::class, 'detail'])->name('products.detail');

// Mua hang
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [MainController::class, 'checkout'])->name('checkout');
Route::get('/checkout/bill', [OrderController::class, 'showBill'])->name('checkout.bill');

// Thanh toán

Route::post('order/add', [OrderController::class, 'add'])->name('order.add');
Route::get('order/show/{id}', [OrderController::class, 'showCart'])->name('order.show');


Route::put('order/{id}/update', [OrderController::class, 'update'])->name('order.update');
Route::get('order/delete', [OrderController::class, 'delete'])->name('order.delete');
Route::get('/don-hang', [OrderController::class, 'myCart'])->name('myCart');
Route::get('/invoices/{id}', [OrderController::class, 'generateInvoice'])->name('invoices');


// admin
Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admins.dashboard');
        })->name('dashboard');

        Route::prefix('accounts')
            ->as('accounts.')
            ->group(function () {
                Route::get('/',[AccountController::class, 'index'])->name('index');
                Route::get('/create',[AccountController::class, 'create'])->name('create');
                Route::post('/store',[AccountController::class, 'store'])->name('store');

                Route::get('{id}/edit',[AccountController::class, 'edit'])->name('edit');
                Route::put('{id}/update',[AccountController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}',[AccountController::class, 'destroy'])->name('destroy');
           });
        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/',[CategoryController::class, 'index'])->name('index');
                Route::get('/create',[CategoryController::class, 'create'])->name('create');
                Route::post('/store',[CategoryController::class, 'store'])->name('store');

                Route::get('/show/{id}',[CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit',[CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update',[CategoryController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}',[CategoryController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/',[ProductController::class, 'index'])->name('index');
                Route::get('/create',[ProductController::class, 'create'])->name('create');
                Route::get('/create-variant',[ProductController::class, 'create_variant'])->name('create_variant');
                Route::post('/store',[ProductController::class, 'store'])->name('store');

                Route::get('/show/{id}',[ProductController::class, 'show'])->name('show');
                Route::get('{id}/edit',[ProductController::class, 'edit'])->name('edit');
                Route::put('{id}/update',[ProductController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}',[ProductController::class, 'destroy'])->name('destroy');
           });
        Route::prefix('sliders')
            ->as('sliders.')
            ->group(function () {
                Route::get('/', [SliderController::class, 'index'])->name('index');
                Route::get('/create', [SliderController::class, 'create'])->name('create');
                Route::get('/create-variant', [SliderController::class, 'create_variant'])->name('create_variant'); // Sửa URL ở đây
                Route::post('/store', [SliderController::class, 'store'])->name('store');

                Route::get('{id}/edit', [SliderController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [SliderController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [SliderController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/', [manageOrderController::class, 'index'])->name('index');

                Route::get('/show/{id}', [manageOrderController::class, 'show'])->name('show');
                Route::put('{id}/update', [manageOrderController::class, 'update'])->name('update');
                Route::delete('/destroy/{id}', [manageOrderController::class, 'destroy'])->name('destroy');
            });
    });


