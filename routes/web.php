<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\FeatureSectionController;
use App\Http\Controllers\Admin\HeaderSectionController;
use App\Http\Controllers\Admin\PartnerSectionController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PushController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MetaDataController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandImagesController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CustomerVoucherController;

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

Route::get('/support', function () {
    return view('support');
})->name('support');
Route::get('/arrive', function () {
    return view('can-arrive');
})->name('arrive');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/safe', function () {
    return view('safe');
})->name('safe');


Route::redirect('/', '/ar');

Route::get('/{locale}', [HeaderSectionController::class, 'showWelcome'])->where('locale', 'en|ar')->name('home');


Route::view('/terms-of-service', 'landing.footer_sections.terms_of_service')->name('terms_of_service');
Route::view('/privacy-policy', 'landing.footer_sections.privacy_policy')->name('privacy_policy');
Route::view('/faq', 'landing.footer_sections.faq')->name('faq');


Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('branch.invoice.show')->withoutMiddleware(['auth', 'active']);
;

Route::middleware(['auth', 'active'])->group(function () {


    //////////dashboard //////////////////
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/header-sections', HeaderSectionController::class);
    Route::resource('/feature-sections', FeatureSectionController::class);
    Route::resource('/about-sections', AboutSectionController::class);
    Route::resource('/partner-sections', PartnerSectionController::class);


    /////////user //////////////////////
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users/activate/{user}', [UserController::class, 'activate'])->name('user.activate');
    Route::post('/users/deactivate/{user}', [UserController::class, 'deactivate'])->name('user.deactivate');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/update/{user}', [UserController::class, 'update'])->name('user.update');


    ///////////notifications////////////////////
    Route::post('/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');


    //////////brands /////////////////
    Route::resource('/brands', BrandController::class);

    Route::resource('/{brand}/images', BrandImagesController::class);

    Route::post('/brands/workingHours/{brand}', [BrandController::class, 'workingHours'])->name('brand.workingHours');
    Route::post('/brands/activate/{brand}', [BrandController::class, 'activate'])->name('brand.activate');
    Route::post('/brands/deactivate/{brand}', [BrandController::class, 'deactivate'])->name('brand.deactivate');

    Route::get('/brands/see/{brand}', [BrandController::class, 'see'])->name('brands.see');
    Route::post('/brands/featured/{brand}', [BrandController::class, 'featured'])->name('brand.featured');
    Route::post('/brands/unfeatured/{brand}', [BrandController::class, 'unfeatured'])->name('brand.unfeatured');

    ////////////branches ////////////////////
    Route::resource('/branch', BranchController::class);

    ////////////roles ////////////////////
    Route::resource('/roles', RolesController::class);

    Route::resource('/vouchers', VoucherController::class);
    Route::get('/newEvent', [VoucherController::class, 'createEvent'])->name('vouchers.createEvent');
    Route::post('/vouchers/storeEvent', [VoucherController::class, 'storeEvent'])->name('voucher.storeEvent');
    Route::post('/vouchers/activate/{voucher}', [VoucherController::class, 'activate'])->name('voucher.activate');
    Route::post('/vouchers/deactivate/{voucher}', [VoucherController::class, 'deactivate'])->name('voucher.deactivate');


    Route::resource('/categories', CategoryController::class);

    Route::resource('/subcategories', SubcategoryController::class);

    Route::resource('/customers', CustomerController::class);
    Route::post('/customers/block/{customer}', [CustomerController::class, 'block'])->name('customer.block');
    Route::post('/customers/unBlock/{customer}', [CustomerController::class, 'unBlock'])->name('customer.unBlock');
    Route::get('/customers/see/{customer}', [CustomerController::class, 'see'])->name('customers.see');


    Route::resource('/invoice', InvoiceController::class);
    Route::get('/branch/invoice/{branch}', [InvoiceController::class, 'invoice'])->name('branch.invoice');
    Route::post('/invoice/activate/{invoice}', [InvoiceController::class, 'paid'])->name('invoice.paid');
    Route::post('/invoice/deactivate/{invoice}', [InvoiceController::class, 'unPaid'])->name('invoice.unPaid');

    Route::get('/sales', [CustomerVoucherController::class, 'index'])->name('sales');
    Route::resource('/rating', RatingController::class);


    Route::get('/settings', [MetaDataController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [MetaDataController::class, 'update'])->name('settings.update');

    //////////Advertise /////////////////
    Route::resource('/advertise', AdvertiseController::class);
    //////////landing /////////////////

    Route::resource('/landing', LandingController::class);

    ///////////////Push Notifications ////////////////////////
    Route::get('/notifications', [PushController::class, 'index'])->name('notifications');
    Route::post('/push', [PushController::class, 'push'])->name('push-notifiations');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('change.language');
// App::setLocale('ar');



require __DIR__ . '/auth.php';
