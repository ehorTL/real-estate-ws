<?php

use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\RealEstateCategoryController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\UserController;
use App\Models\RealEstate\ContractType;
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

Route::prefix('common')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('real-estate/{id}', [RealEstateController::class, 'show']);
    Route::get('real-estate-featured', [RealEstateController::class, 'getFeatured']);
    Route::get('real-estate-contract-types', [ContractTypeController::class, 'showAll']);
    Route::get('real-estate-categories', [RealEstateCategoryController::class, 'showAll']);
    Route::get('real-estate-currency', [CurrencyController::class, 'showAll']);
});

Route::middleware('auth_custom_token')->prefix('admin')->group(function () {
    Route::post('real-estate', [RealEstateController::class, 'create']);
    Route::put('real-estate/{id}', [RealEstateController::class, 'update']);
    Route::delete('real-estate/{id}', [RealEstateController::class, 'delete']);

    Route::post('set-rs-main-img', [RealEstateController::class, 'setMainPhoto']);
    Route::delete('delete-rs-main-img/{real_estate_id}', [RealEstateController::class, 'deleteMainPhoto']);
    Route::post('upload-rs-img', [RealEstateController::class, 'uploadImage']);
    Route::delete('delete-rs-img/{real_estate_photo_id}', [RealEstateController::class, 'deleteImage']);

    Route::post('upload-rs-imgs', [RealEstateController::class, 'uploadimages']);
});
