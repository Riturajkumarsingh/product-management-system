<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| All routes here are prefixed with /api automatically.
| Public:    GET  /api/products, GET /api/products/{id}
| Protected: POST, PUT, DELETE require Bearer token
|            Authorization: Bearer {token}
*/

// ── Auth endpoints (public) ────────────────────────────────────────────────
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login',    [AuthController::class, 'login'])->name('api.login');

// ── Public read endpoints (no token required) ──────────────────────────────
Route::get('/products',      [ProductController::class, 'index'])->name('api.products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('api.products.show');

// ── Protected write endpoints (Bearer token required) ──────────────────────
Route::middleware('api.token')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    // Products – create, update, delete
    Route::post('/products',           [ProductController::class, 'store'])->name('api.products.store');
    Route::put('/products/{product}',  [ProductController::class, 'update'])->name('api.products.update');
    Route::patch('/products/{product}',[ProductController::class, 'update']);
    Route::delete('/products/{product}',[ProductController::class, 'destroy'])->name('api.products.destroy');
});
