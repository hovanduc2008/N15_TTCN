<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AuthController;
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

        Route::post('/register', [AuthController::class, 'handleRegister']);
        Route::post('/login', [AuthController::class, 'handleLogin']);
        Route::get('/logout', [AuthController::class, 'handelLogout']) -> name('admin.logout');
    });

    Route::middleware('admin.login') -> prefix('/dashboard') -> group(function() {
        Route::view('/' ,'admin.dashboard.index') -> name('admin.dashboard');
    });


    Route::middleware('admin.login') -> prefix('product') -> group(function() {

        Route::get('/', [ProductController::class, 'index']) -> name('admin.products');

        Route::get('create', [ProductController::class, 'createForm']) -> name('admin.product.create');
        Route::post('create', [ProductController::class, 'handleCreate']);

        Route::get('edit/{id}', [ProductController::class, 'editForm']) -> name('admin.product.edit');
        Route::put('edit/{id}', [ProductController::class, 'handleEdit']);

        Route::delete('delete/{id}', [ProductController::class, 'handleDelete']) -> name('admin.product.delete');

        Route::get('filter', [ProductController::class, 'filterProducts']) -> name('admin.product.filter');
    });

    Route::middleware('admin.login') -> prefix('category') -> group(function() {

        Route::get('/', [CategoryController::class, 'index']) -> name('admin.categories');;

        Route::get('create', [CategoryController::class, 'createForm']) -> name('admin.category.create');
        Route::post('create', [CategoryController::class, 'handleCreate']);

        Route::get('edit/{id}', [CategoryController::class, 'editForm']) -> name('admin.category.edit');
        Route::put('edit/{id}', [CategoryController::class, 'handleEdit']);

        Route::delete('delete/{id}', [CategoryController::class, 'handleDelete']) -> name('admin.category.delete');
    });

    Route::middleware('admin.login') -> prefix('author') -> group(function() {

        Route::get('/', [AuthorController::class, 'index']) -> name('admin.authors');;

        Route::get('create', [AuthorController::class, 'createForm']) -> name('admin.author.create');
        Route::post('create', [AuthorController::class, 'handleCreate']);

        Route::get('edit/{id}', [AuthorController::class, 'editForm']) -> name('admin.author.edit');
        Route::put('edit/{id}', [AuthorController::class, 'handleEdit']);

        Route::delete('delete/{id}', [AuthorController::class, 'handleDelete']) -> name('admin.author.delete');
    });

    Route::middleware('admin.login') -> prefix('order') -> group(function() {

        Route::get('/', [OrderController::class, 'index']) -> name('admin.orders');

        Route::get('/{id}', [OrderController::class, 'detail']) -> name('admin.orders.detail');
        Route::put('/change-status/{id}', [OrderController::class, 'changeStatus']) -> name('admin.orders.change_status');
    });

});

