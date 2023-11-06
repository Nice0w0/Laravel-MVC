<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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
    if (auth()->check()) {
        $productController = new ProductController();
        return $productController->read();
    } else {
        return view('auth.login');
    }
});

Route::post('/create', [ProductController::class, 'create']);
Route::post('/del', [ProductController::class, 'destroy']);
Route::post('/edit', [ProductController::class, 'update']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $productController = new ProductController();
        return $productController->read();
    })->name('dashboard');
});
