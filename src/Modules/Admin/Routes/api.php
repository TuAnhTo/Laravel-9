<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\ProductController;

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

Route::group(['prefix' => 'v1/', 'namespace' => 'V1'], static function () {
    Route::post('/register', [AuthController::class, 'store']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::put('/logout', [AuthController::class, 'logout']);

    Route::get('/verify', [AuthController::class, 'verify']);

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

    Route::get('/verify-forgot-password', [AuthController::class, 'verifyForgotPassword']);

    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::post('/resend-verify', [AuthController::class, 'resendVerify']);

    Route::group(['middleware' => ['api', 'jwt.auth']], function () {
        Route::group(['prefix' => 'products'], static function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::post('/', [ProductController::class, 'store']);
            Route::get('/{id}', [ProductController::class, 'show']);
            Route::put('/{id}', [ProductController::class, 'update']);
        });
    });

});
