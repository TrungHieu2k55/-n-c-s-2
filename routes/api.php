<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'checklogin:1'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Bạn có thể thêm các route khác ở đây
    Route::get('/another-route', [AnotherController::class, 'method'])->name('another.route');
});
