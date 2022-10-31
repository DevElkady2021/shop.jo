<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatagoryController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' =>['api','ChangeLanguage'],
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);   //register
    Route::post('/login', [AuthController::class, 'login']);  // login
});


Route::group([
    'middleware' => ['api','ChangeLanguage','token:api'],
    'prefix' => 'auth'
], function () {
   
    Route::get('/profile/{id}',[ProfileController::class,'show']);       //profile
    Route::post('/update_profile/{id}',[ProfileController::class,'update']);
    Route::post('/logout', [AuthController::class, 'logout']);           //logout

    //------------------  Catagory - Route -------------------------
    Route::get('main_catagory/{id}',[CatagoryController::class,'show']);
    Route::get('sub_catagory/{id}',[CatagoryController::class,'sub_catagory']);
    Route::post('catagory',[CatagoryController::class,'store']);
    Route::post('catagory_update/{id}',[CatagoryController::class,'update']);
    Route::get('catagory_delete/{id}',[CatagoryController::class,'destroy']);
    Route::get('catagory',[CatagoryController::class,'index']);
    //------------------  Product - Route -------------------------

    Route::get('product',[ProductController::class,'index']);
    Route::post('product_store',[ProductController::class,'store']);
    Route::post('product_update/{id}',[ProductController::class,'update']);
    Route::get('product_delete/{id}',[ProductController::class,'destroy']);




});



