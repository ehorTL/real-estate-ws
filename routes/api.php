<?php

use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\Controller;
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

Route::get('hello', [Controller::class, 'foo']);

Route::prefix('admin')->group(function () {
    Route::post('real-estate', [RealEstateController::class, 'create']);
    Route::get('real-estate/{id}', [RealEstateController::class, 'show']);
    // Route::put('real-estate/{id}', 'RealEstateController@update');
    Route::delete('real-estate/{id}', [RealEstateController::class, 'delete']);
    Route::get('real-estate-featured', [RealEstateController::class, 'getFeatured']);

    Route::get('real-estate-contract-types', [ContractTypeController::class, 'showAll']);
    Route::get('real-estate-categories', [RealEstateCategoryController::class, 'showAll']);

    Route::post('has-rights', [UserController::class, 'hasRights']);

    Route::post('set-rs-main-img', [RealEstateController::class, 'setMainPhoto']);
    Route::delete('delete-rs-main-img', [RealEstateController::class, 'deleteMainPhoto']);
    Route::post('upload-rs-img', [RealEstateController::class, 'uploadImage']);
    Route::delete('delete-rs-img/{real_estate_photo_id}', [RealEstateController::class, 'deleteImage']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
