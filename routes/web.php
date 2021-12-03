<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Products\Products;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Customers\Customers;
use Illuminate\Routing\Route as RoutingRoute;

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

// route::get('/test', function () {

//     return auth()->user()->role->name;
// })->middleware('can:create,user');


Auth::routes();

Route::get('/', DashboardController::class)->name('dashboard')->middleware('auth');
Route::get('/users', Users::class)->name('users')->middleware('auth');
Route::get('/categories', Categories::class)->name('categories')->middleware('auth');
Route::get('/products', Products::class)->name('products')->middleware('auth');
Route::get('/customers', Customers::class)->name('customers')->middleware('auth');
