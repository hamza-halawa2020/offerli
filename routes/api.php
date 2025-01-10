<?php

use App\Http\Controllers\Api\AdvertiseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerFavouriteController;
use App\Http\Controllers\Api\OfferServiceController;
use App\Http\Controllers\Api\ReviewServiceController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserNotificationController;
use App\Http\Controllers\Api\VoucherController;
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

use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Brand\BrandAuthController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Meta\MetaController;

//////////////////////////MetaData API //////////////////////////
Route::post('/updateURLS', [MetaController::class, 'updateURLS']);


//////////////////////////Category API //////////////////////////
Route::apiResource('/categories', CategoryController::class);
Route::get('/sub_categories', [CategoryController::class, 'getAllSubCategories']);
Route::get('/sub_categories/{id}', [CategoryController::class, 'getOneSubCategory']);


//////////////////////////ads API //////////////////////////
Route::get('/ads', [AdvertiseController::class, 'index']);
Route::get('/ads/{id}', [AdvertiseController::class, 'show']);



//////////////////////////vouchers API //////////////////////////
Route::get('/vouchers', [VoucherController::class, 'index']);
Route::get('/vouchers/{id}', [VoucherController::class, 'show']);

/////////////////// notifications API's //////////////////////////
Route::apiResource('/notifications', UserNotificationController::class, );
Route::get('notifications/{id}/read', [UserNotificationController::class, 'markAsRead']);

/////////////////// Customer API's //////////////////////////
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/customer/register', [CustomerAuthController::class, 'register']);

Route::middleware(['auth:customer'])->prefix('customer')->group(function () {
    Route::post('/logout', [CustomerAuthController::class, 'logout']);
    Route::post('/updateprofile', [CustomerAuthController::class, 'updateprofile']);
    Route::post('/updatetoken', [CustomerAuthController::class, 'updatetoken']);
    Route::post('/updatepassword', [CustomerAuthController::class, 'updatepassword']);
    Route::delete('/delete', [CustomerAuthController::class, 'deleteAccount']);

    Route::get('/favourites', [CustomerFavouriteController::class, 'index']);
    Route::post('/favourites', [CustomerFavouriteController::class, 'store']);
    Route::get('/favourites/{id}', [CustomerFavouriteController::class, 'show']);
    Route::post('/favourites/{id}', [CustomerFavouriteController::class, 'destroy']);

    Route::get('/profile', [CustomerController::class, 'profile']);
    Route::get('/payments', [CustomerController::class, 'payments']);
    Route::get('/status', [CustomerController::class, 'status']);
    Route::get('/brands', [CustomerController::class, 'brands']);
    Route::get('/vouchers', [CustomerController::class, 'vouchers']);
    Route::get('/adverises', [CustomerController::class, 'adverises']);

    Route::post('/usevoucher', [CustomerController::class, 'usevoucher']);
    Route::post('/redeem', [CustomerController::class, 'redeem']);
    Route::post('/addwishlist', [CustomerController::class, 'addwishlist']);
    Route::post('/removeWishlist', [CustomerController::class, 'removeWishlist']);
    Route::get('/history', [CustomerController::class, 'history']);


    /////////////////// customer review the srvice //////////////////////////

    Route::post('/service/{serviceId}', [ReviewServiceController::class, 'addReview']);


});


/////////////////// Brand API's //////////////////////////
Route::post('/brand/login', [BrandAuthController::class, 'login']);
Route::post('/brand/register', [BrandAuthController::class, 'register']);
Route::get('/brand/services', [ServiceController::class, 'index']);
// Route::get('/brand/services/{id}', [ServiceController::class, 'show']);
Route::get('/brand/services/{id}', [ServiceController::class, 'show'])->where('id', '[0-9]+');
Route::get('/brand/services/search', [ServiceController::class, 'search']);



Route::middleware(['auth:brand'])->prefix('brand')->group(function () {


    Route::post('/notifications', [UserNotificationController::class, 'store']);
    Route::put('/notifications/{id}', [UserNotificationController::class, 'update']);
    Route::delete('/notifications/{id}', [UserNotificationController::class, 'destroy']);




    //////////////////////////vouchers API //////////////////////////
    Route::post('/vouchers', [VoucherController::class, 'store']);
    Route::put('/vouchers/{id}', [VoucherController::class, 'update']);
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy']);



    //////////////////////////services API //////////////////////////
    Route::post('/services', [ServiceController::class, 'store']);
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
    Route::put('/services/{id}', [ServiceController::class, 'update']);

    Route::post('/offers/{serviceId}', [OfferServiceController::class, 'store']);
    Route::put('/offers/{serviceId}', [OfferServiceController::class, 'update']);
    Route::delete('/offers/{serviceId}', [OfferServiceController::class, 'destroy']);

    Route::post('/logout', [BrandAuthController::class, 'logout']);
    Route::post('/updateprofile', [BrandAuthController::class, 'updateprofile']);
    Route::post('/updatetoken', [BrandAuthController::class, 'updatetoken']);
    Route::post('/updatepassword', [BrandAuthController::class, 'updatepassword']);
    Route::delete('/delete', [BrandAuthController::class, 'deleteAccount']);

    Route::get('/profile', [BrandController::class, 'profile']);
    Route::get('/branches', [BrandController::class, 'branches']);
    Route::post('/addImage', [BrandController::class, 'addImage']);
    Route::post('/deleteImage', [BrandController::class, 'deleteImage']);
    Route::post('/newbranch', [BrandController::class, 'newbranch']);
    Route::post('/showbranch', [BrandController::class, 'showbranch']);
    Route::post('/editbranch', [BrandController::class, 'editbranch']);
    Route::post('/deletebranch', [BrandController::class, 'deletebranch']);

    Route::post('/workingHours', [BrandController::class, 'workingHours']);
    Route::post('/befeatured', [BrandController::class, 'befeatured']);
    Route::post('/beredeemed', [BrandController::class, 'beredeemed']);
    Route::post('/newVoucher', [BrandController::class, 'newVoucher']);
    Route::post('/newEvent', [BrandController::class, 'newEvent']);
    Route::post('/deleteEvent', [BrandController::class, 'deleteEvent']);
    Route::get('/brandVouchers', [BrandController::class, 'brandVouchers']);
    Route::post('/branchVouchers', [BrandController::class, 'branchVouchers']);
    Route::post('/deleteVoucher', [BrandController::class, 'deleteVoucher']);
    Route::post('/addVoucherBranch', [BrandController::class, 'addVoucherBranch']);
    Route::post('/deleteBranchVouchers', [BrandController::class, 'deleteBranchVouchers']);
});

