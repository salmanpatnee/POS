<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Categories\Categories;
use App\Http\Livewire\Products\Products;
use App\Http\Livewire\Users\Users;
use App\Http\Livewire\Customers\Customers;
use App\Http\Livewire\Sales\NewSale;
use App\Http\Livewire\Sales\Sales;
use App\Models\Sale;
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

//     $latestSale = Sale::orderBy('created_at', 'DESC')->first();
//     $invoiceNum = 1;

//     if (!is_null($latestSale)) {
//         $invoiceNum = $latestSale->id + 1;
//     }

//     return str_pad($invoiceNum, 8, "0", STR_PAD_LEFT);


// });


Auth::routes();

Route::get('/', DashboardController::class)->name('dashboard')->middleware('auth');
Route::get('/users', Users::class)->name('users')->middleware('auth');
Route::get('/categories', Categories::class)->name('categories')->middleware('auth');
Route::get('/products', Products::class)->name('products')->middleware('auth');
Route::get('/customers', Customers::class)->name('customers')->middleware('auth');
Route::get('/sales', Sales::class)->name('sales')->middleware('auth');
Route::get('/sales/create', NewSale::class)->name('sales.create')->middleware('auth');
