<?php

use App\Http\Controllers\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api get list categories
Route::get('/getCatalogue', [\App\Http\Controllers\CategoryController::class, 'getAllCategories']);
// api get list district from province_id
Route::get('/provinces', [ProvinceController::class, 'getProvinces']);
Route::get('/districts/{province_id}', [ProvinceController::class, 'getDistrictByProvinceId']);
Route::get('/wards/{district_id}', [ProvinceController::class, 'getWardByDistrictId']);
// get location for FE box search select 2
Route::get('/getDistrict', [ProvinceController::class, 'getDistrict']);
Route::get('/getWard', [ProvinceController::class, 'getWard']);
// contact client
Route::post('/client-contact-item', [\App\Http\Controllers\ContactController::class, 'clientSubmit']);

