<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Products\ProductListGetAction;

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

// Frontend page routes
Route::group(['namespace' => 'V1', 'prefix' => 'v1'], function () {

    Route::group(['namespace' => 'Products', 'prefix' => 'products'], function () {

        Route::get('/', [ProductListGetAction::class, '__invoke'])->name('back.products.get');
    });
});
