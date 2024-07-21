<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\CategoryChildController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'parent_categories'], function () {
    Route::get('/', [ParentCategoryController::class, 'index']);
    Route::get('/add', [ParentCategoryController::class, 'add']);
    Route::get('/edit', [ParentCategoryController::class, 'add']);
    Route::get('/delete', [ParentCategoryController::class, 'delete']);
    Route::Post('/store', [ParentCategoryController::class, 'store']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/tree', [CategoryController::class, 'tree']);
    
    Route::get('/', [CategoryController::class, 'index']);

    Route::get('/add', [CategoryController::class, 'add']);
    Route::get('/edit', [CategoryController::class, 'add']);
    Route::get('/delete', [CategoryController::class, 'delete']);
    Route::Post('/store', [CategoryController::class, 'store']);
});
