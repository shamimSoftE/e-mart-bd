<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactSMSController;
use App\Http\Controllers\OrderCancelController;
use App\Http\Controllers\ShippingAddressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('home');


Route::get('/new-product', [FrontController::class, 'latest'])->name('latest_product');
Route::get('/single-product/{product:slug}', [FrontController::class, 'single'])->name('single_view');
Route::get('/view-{section:slug}', [FrontController::class, 'viewMore'])->name('view_more');

// contact page
Route::get('contact-us', [FrontController::class, 'contact'])->name('contact');
Route::post('customer-question', [ContactSMSController::class, 'conSMS'])->name('contact_sms');

// about page
Route::get('about-real-shop', [FrontController::class, 'about'])->name('about');

// category wise product show
Route::get('category-wise/{id}', [FrontController::class, 'cateWise'])->name('category_wise');
Route::get('category/{id}', [FrontController::class, 'mainCateWise'])->name('main_category_wise');

// brand wise
Route::get('brand-wise/{id}', [FrontController::class, 'brandWise'])->name('brand_wise');

// banner wise
Route::get('offer-campain/{id}', [FrontController::class, 'bannerWise'])->name('banner_wise_product');

// find product
Route::get('item-find', [FrontController::class, 'search'])->name('search_item');

Route::get('price-range', [FrontController::class, 'priceRange'])->name('price_range');

// cart route start here <==============
Route::post('cart-add-item', [CartController::class, 'store'])->name('cart_store');
Route::post('cart-store-direct', [CartController::class, 'akhoneKinun'])->name('cart_store2');
Route::get('cart-show',[CartController::class, 'showCart'])->name('cart_item');
Route::post('cart-update',[CartController::class, 'update'])->name('cart_update');
Route::get('cart-remove-{rowId}',[CartController::class, 'destroy'])->name('cart_destroy');

// customer route <================
Route::post('customer-login', [CustomerController::class, 'login'])->name('customer_login');
Route::post('customer-registration', [CustomerController::class, 'store'])->name('customer_register');
// Route::get('customer-password-forgot', [CustomerController::class, 'forgot'])->name('forgot-pass');
// Route::post('customer-password-reset', [CustomerController::class, 'reset'])->name('pass_reset');



Route::group(['middleware' => 'auth'], function () {
    Route::get('customer-dashboard', [CustomerController::class, 'dashboard'])->name('customer_dashboard');
    Route::post('customer-update/{id}', [CustomerController::class, 'update'])->name('update_customerInfo');
    Route::post('customer-logout', [CustomerController::class, 'logout'])->name('customer_logout');

    // shipping address
    Route::prefix('shipping')->group(function () {
        Route::get('address-add-form', [ShippingAddressController::class, 'showForm'])->name('add_shippingAddress');
        Route::post('delivery-address-store', [ShippingAddressController::class, 'storeShipping'])->name('address_store');
        Route::get('address-edit/{id}', [ShippingAddressController::class, 'edit'])->name('shipping_edit');
        Route::post('address-update/{id}', [ShippingAddressController::class, 'update'])->name('shipping_address_update');
        Route::get('address-destroy/{id}', [ShippingAddressController::class, 'destroy'])->name('shipping_destroy');
    });

    Route::post('checkout',[OrderController::class, 'checkout'])->name('checkout');
    Route::get('order-completed',[OrderController::class, 'complete'])->name('order_complete');

    // customer review
    Route::post('customer-reivew', [ReviewController::class, 'store'])->name('review_store');
    Route::post('order-cancel-reason', [OrderCancelController::class, 'store'])->name('orderCancelStore');

});

//============================= Back-End route start here ===========

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashBoardController::class, 'home'])->name('dashboard');
    Route::get('/profile-view/{id}', [DashBoardController::class, 'profile'])->name('profile_show');
    Route::post('/update-{id}', [DashBoardController::class, 'proUpdate'])->name('profile_update');

    Route::resource('section', SectionController::class);
    Route::get('/section-status/{id}', [SectionController::class, 'status'])->name('section_status');

    // delivery charge
    Route::resource('charge', DeliveryChargeController::class);
    Route::get('/delivery-status/{id}', [DeliveryChargeController::class, 'status'])->name('charge_status');

    //    ================ category parent================
    Route::prefix('parent')->group(function () {
        Route::get('-all', [CategoryController::class, 'All_Parent'])->name('category_parent');
        Route::post('-cate-store', [CategoryController::class, 'parent_store'])->name('parent_cate_store');
        Route::post('-cate-update', [CategoryController::class, 'parent_update'])->name('parent_cate_update');
        Route::get('-cate-delete/{id}', [CategoryController::class, 'parent_cate_del'])->name('parent_cate_destroy');
        Route::get('-cate-status/{id}', [CategoryController::class, 'status'])->name('parent_status');
    });

    Route::get('meke_menu_cate', [CategoryController::class, 'makeMenuCate']);

//    ============ sub category=========
    Route::resource('sub-category', CategoryController::class);
    Route::get('-active/{id}', [CategoryController::class, 'active'])->name('category_active');
    Route::get('-inactive/{id}', [CategoryController::class, 'inactive'])->name('category_inactive');

    // site info
    Route::resource('site', SiteInfoController::class);

    // slider
    Route::resource('slider', SliderController::class);
    Route::get('/status-454{id}54', [SliderController::class, 'status'])->name('slider_status');

    Route::resource('/brand',BrandController::class);
    Route::get('/status/{id}', [BrandController::class, 'status'])->name('brand_status');

    Route::resource('color', ColorController::class);
    Route::get('/color{id}', [ColorController::class, 'deactive'])->name('color_hide');
    Route::get('/color{id}', [ColorController::class, 'show'])->name('color_show');

    Route::resource('banner', BannerController::class);
    Route::get('banner-status/{id}', [BannerController::class, 'status'])->name('banner_status');


    Route::resource('product', ProductController::class);
    // Route::get('/affiliate-products', [ProductController::class, 'affliateProduct'])->name('product.affiliate.list');
    Route::get('/status-245{id}450', [ProductController::class, 'status'])->name('pro_status');

    Route::get('product/cate-append/{id}', [ProductController::class, 'append'])->name('cateAppend');
    Route::get('cate-edit-append/{id}', [ProductController::class, 'editPro']);

    // admin
    Route::prefix('admin')->group(function () {
        Route::get('/register', [AdminController::class, 'register'])->name('admin_create');
        Route::post('/admin-store', [AdminController::class, 'store'])->name('admin_store');
        Route::get('/list', [AdminController::class, 'index'])->name('admin_index');
        Route::post('/destroy/{id}', [AdminController::class, 'destroy'])->name('admin_delete');
    });

    // order
    Route::prefix('order')->group(function() {
        Route::get('list',[OrderController::class, 'index'])->name('order_list');
        Route::get('todays',[OrderController::class, 'todayOrder'])->name('order_today');
        Route::get('view/{id}',[OrderController::class, 'view'])->name('order_view');
        Route::get('invoice-view/{id}',[OrderController::class, 'invoice'])->name('order_invoice');
        Route::post('destroy/{id}',[OrderController::class, 'destroy'])->name('order_destroy');
        Route::get('status/{id}',[OrderController::class, 'status'])->name('order_status');
        Route::get('canceled-order',[OrderCancelController::class, 'canceledOrder'])->name('order_cancel');
    });

    // about
    Route::get('about-page', [DashBoardController::class, 'aboutAddOrEdit'])->name('AddEdit');
    Route::post('about-store', [DashBoardController::class, 'storeAbout'])->name('storeAbout');
    Route::post('about-update/{id}', [DashBoardController::class, 'aboutUpdate'])->name('about_update');

    // contact
    Route::get('contact-page', [DashBoardController::class, 'contactAddEdit'])->name('conAddEdit');
    Route::post('contact-store', [DashBoardController::class, 'storeContact'])->name('storeContact');
    Route::post('contact-update/{id}', [DashBoardController::class, 'contactUpdate'])->name('contactUpdate');

    //contact-sms
    Route::get('contactSMS', [ContactSMSController::class, 'list'])->name('con_SMS');
    Route::post('contact-sms-destroy/{id}', [ContactSMSController::class, 'destroy'])->name('sms_delete');

});

require __DIR__.'/auth.php';
