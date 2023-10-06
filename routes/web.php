<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\BorrowController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AuthorController;
use App\Http\Controllers\admin\OrderController;

use App\Http\Controllers\CKEditorController;


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

Route::get('/', function () {
    return view('welcome');
}) -> name('welcome');

Route::prefix('/admin') -> group(function() {

    

    Route::prefix('/') -> group(function() {
        Route::get('/register', [AuthController::class, 'register']) -> name('admin.register');
        Route::get('/login', [AuthController::class, 'login']) -> name('admin.login');

        Route::post('/register', [AuthController::class, 'handleRegister'] ) -> name('admin.handleRegister');
        Route::post('/login', [AuthController::class, 'handleLogin']) -> name('admin.handleLogin');
        Route::get('/logout', [AuthController::class, 'handelLogout']) -> name('admin.logout');
    });

    Route::middleware('admin.login') -> prefix('/dashboard') -> group(function() {
        Route::view('/' ,'admin.dashboard.index') -> name('admin.dashboard');
    });



    // Customer Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('customer') -> group(function() {
        Route::get('/', [CustomerController:: class, 'index']) -> name('admin.customers');
    });



    // Borrow Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('borrows') -> group(function() {
        Route::get('/', [BorrowController:: class, 'index']) -> name('admin.borrows');

        Route::get('/create', [BorrowController::class, 'createForm']) -> name('admin.borrow.create');
        Route::post('/create', [BorrowController::class, 'handleCreate']) -> name('admin.borrow.handleCreate');

        Route::get('edit/{id}', [BorrowController::class, 'editForm']) -> name('admin.borrow.edit');
        Route::put('edit/{id}', [BorrowController::class, 'handleEdit']) -> name('admin.borrow.handleEdit');

        Route::get('/filterbyuser/{user_id}/{type}', [BorrowController:: class, 'filterByUser']) -> name('admin.borrow.filterbyuser');
        Route::get('/filterbyproduct/{product_id}', [BorrowController:: class, 'filterByProduct']) -> name('admin.borrow.filterbyproduct');
    });



    // Product Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('product') -> group(function() {

        Route::get('/', [ProductController::class, 'index']) -> name('admin.products');

        Route::get('create', [ProductController::class, 'createForm']) -> name('admin.product.create');
        Route::post('create', [ProductController::class, 'handleCreate']) -> name('admin.product.handleCreate');

        Route::get('edit/{id}', [ProductController::class, 'editForm']) -> name('admin.product.edit');
        Route::put('edit/{id}', [ProductController::class, 'handleEdit']) -> name('admin.product.handleEdit');

        Route::delete('delete/{id}', [ProductController::class, 'handleDelete']) -> name('admin.product.delete');

        Route::get('filter', [ProductController::class, 'filterProducts']) -> name('admin.product.filter');
        Route::get('borrowproducts', [ProductController::class, 'borrowProducts']) -> name('admin.product.borrowproducts');
    });


    // Category Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('category') -> group(function() {

        Route::get('/', [CategoryController::class, 'index']) -> name('admin.categories');;

        Route::get('create', [CategoryController::class, 'createForm']) -> name('admin.category.create');
        Route::post('create', [CategoryController::class, 'handleCreate']) -> name('admin.category.handleCreate');

        Route::get('edit/{id}', [CategoryController::class, 'editForm']) -> name('admin.category.edit');
        Route::put('edit/{id}', [CategoryController::class, 'handleEdit']) -> name('admin.category.handleEdit');

        Route::delete('delete/{id}', [CategoryController::class, 'handleDelete']) -> name('admin.category.delete');
    });


    // Author Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('author') -> group(function() {

        Route::get('/', [AuthorController::class, 'index']) -> name('admin.authors');;

        Route::get('create', [AuthorController::class, 'createForm']) -> name('admin.author.create');
        Route::post('create', [AuthorController::class, 'handleCreate']) -> name('admin.author.handleCreate');

        Route::get('edit/{id}', [AuthorController::class, 'editForm']) -> name('admin.author.edit');
        Route::put('edit/{id}', [AuthorController::class, 'handleEdit']) -> name('admin.author.handleEdit');

        Route::delete('delete/{id}', [AuthorController::class, 'handleDelete']) -> name('admin.author.delete');
    });


    // Order Route------------------------------------------------------------------------
    Route::middleware('admin.login') -> prefix('order') -> group(function() {

        Route::get('/', [OrderController::class, 'index']) -> name('admin.orders');
        Route::get('statistics', [OrderController::class, 'statistics']) -> name('admin.statistics');

        Route::get('/{id}', [OrderController::class, 'detail']) -> name('admin.orders.detail');
        Route::put('/change-status/{id}', [OrderController::class, 'changeStatus']) -> name('admin.orders.change_status');
    });

});

