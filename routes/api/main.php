<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Mail\Welcome;
use App\Http\Controllers\API\Main\{BrandController,
    BrandsController,
    CategoryController,
    CategoriesController,
    ProductController,
    ProductsController};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

ROute::get('/',function (){
   Mail::to('am@aol.com')->send(new Welcome());
});
Route::get('products', ProductsController::class)->name('products');
Route::get('categories', CategoriesController::class)->name('categories');
Route::get('brands', BrandsController::class)->name('brands');
Route::get('brand/{id}',BrandController::class)->name('brand');
Route::get('product/{id}', ProductController::class)->name('product');
Route::get('category/{id}', CategoryController::class)->name('category');

