<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopgridController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ShopgridController::class, 'index'])->name('home');
Route::get('/category-product', [ShopgridController::class, 'categoryProduct'])->name('category-product');
Route::get('/product-detail', [ShopgridController::class, 'productDetail'])->name('product-detail');
Route::get('/add-to-cart', [CartController::class, 'index'])->name('add-to-cart');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-category',[CategoryController::class, 'index'])->name('add-category');
Route::middleware(['auth:sanctum', 'verified'])->post('/new-category',[CategoryController::class, 'create'])->name('new-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-category',[CategoryController::class, 'manage'])->name('manage-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-category/{id}',[CategoryController::class, 'edit'])->name('edit-category');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-category/{id}',[CategoryController::class, 'update'])->name('update-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-category/{id}',[CategoryController::class, 'delete'])->name('delete-category');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-sub-category',[SubCategoryController::class, 'index'])->name('add-sub-category');
Route::middleware(['auth:sanctum', 'verified'])->post('/new-sub-category',[SubCategoryController::class, 'create'])->name('new-sub-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-sub-category',[SubCategoryController::class, 'manage'])->name('manage-sub-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-sub-category/{id}',[SubCategoryController::class, 'edit'])->name('edit-sub-category');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-sub-category/{id}',[SubCategoryController::class, 'update'])->name('update-sub-category');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-sub-category/{id}',[SubCategoryController::class, 'delete'])->name('delete-sub-category');


Route::middleware(['auth:sanctum', 'verified'])->get('/add-brand',[BrandController::class, 'index'])->name('add-brand');
Route::middleware(['auth:sanctum', 'verified'])->post('/new-brand',[BrandController::class, 'create'])->name('new-brand');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-brand',[BrandController::class, 'manage'])->name('manage-brand');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-brand/{id}',[BrandController::class, 'edit'])->name('edit-brand');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-brand/{id}',[BrandController::class, 'update'])->name('update-brand');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-brand/{id}',[BrandController::class, 'delete'])->name('delete-brand');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-unit',[UnitController::class, 'index'])->name('add-unit');
Route::middleware(['auth:sanctum', 'verified'])->post('/new-unit',[UnitController::class, 'create'])->name('new-unit');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-unit',[UnitController::class, 'manage'])->name('manage-unit');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-unit/{id}',[UnitController::class, 'edit'])->name('edit-unit');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-unit/{id}',[UnitController::class, 'update'])->name('update-unit');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-unit/{id}',[UnitController::class, 'delete'])->name('delete-unit');

Route::middleware(['auth:sanctum', 'verified'])->get('/add-product',[ProductController::class, 'index'])->name('add-product');
Route::middleware(['auth:sanctum', 'verified'])->post('/new-product',[ProductController::class, 'create'])->name('new-product');
Route::middleware(['auth:sanctum', 'verified'])->get('/manage-product',[ProductController::class, 'manage'])->name('manage-product');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-product/{id}',[ProductController::class, 'edit'])->name('edit-product');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-product/{id}',[ProductController::class, 'update'])->name('update-product');
Route::middleware(['auth:sanctum', 'verified'])->get('/delete-product/{id}',[ProductController::class, 'delete'])->name('delete-product');


