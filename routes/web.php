<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

// Login and Registration routes
Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
Route::get('/gotodashboard', [LoginRegisterController::class, 'gotodashboard'])->name('gotodashboard');

// Dashboard route
Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');

// Product routes
// get
Route::get('/showprod', [LoginRegisterController::class, 'showprod'])->name('showprod');
Route::get('/addprod', [LoginRegisterController::class, 'addprod'])->name('addprod');
Route::get('/editprod/{id}', [LoginRegisterController::class, 'editprod'])->name('editprod');
// post
Route::post('/addproducts', [ProductController::class, 'add'])->name('products.store');
Route::post('/editproducts/{id}', [ProductController::class, 'edit'])->name('products.update');
Route::get('deleteproducts/{id}', [ProductController::class, 'delete'])->name('products.delete');
Route::get('/searchproducts', [LoginRegisterController::class, 'search'])->name('products.search');
Route::post('/fetch-products', [LoginRegisterController::class, 'fetchProducts'])->name('fetchProducts');



// Product type route
// get
Route::get('/showprodtype', [LoginRegisterController::class, 'showprodtype'])->name('showprodtype');
Route::get('/addprodtype', [LoginRegisterController::class, 'addprodtype'])->name('addprodtype');
// post
Route::post('/addproductstype', [ProductController::class, 'addtype'])->name('products.type.store');
Route::post('/editproductstype/{id}', [ProductController::class, 'edittype'])->name('products.type.update');
Route::get('/editprodtype/{id}', [LoginRegisterController::class, 'editprodtype'])->name('editprodtype');
Route::get('deleteproductstype/{id}', [ProductController::class, 'deletetype'])->name('products.type.delete');


// Order route
Route::get('/addorder', [LoginRegisterController::class, 'addorder'])->name('addorder');

// Resource route
Route::resource('orders', OrderController::class);
Route::get('/orders/{id}/generate-pdf/{products_id}', [OrderController::class, 'generatePdf'])->name('orders.generatePdf');
Route::get('/export-order', [OrderController::class, 'export'])->name('orders.export');


