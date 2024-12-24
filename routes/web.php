<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [AuthController::class, 'showLoginForm'])->name('logins');
// nháp
// Route::get('/login/signin', 'App\Http\Controllers\Admin\product@index')->name('signin');
// Route::get('/login/signup', 'App\Http\Controllers\Admin\product@create')->name('signup');

//

Route::get('/login/signin', [AuthController::class, 'showLoginForm'])->name('login');
Route::any('/login', [AuthController::class, 'login'])->name('alogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logoutcus', [AuthController::class, 'logoutcus'])->name('logoutcus');




Route::middleware(['checklogin:1'])->group(function () {
    Route::get('/administrators/order', [DashBoardController::class, 'showorder'])->name('showorder');
    Route::put('/orders/{ma_don_hang}/update-status', [DashBoardController::class, 'updateStatus'])->name('update.order.status');
    Route::get('/administrators/layouts/index', [DashBoardController::class, 'index'])->name('index');
    Route::get('/statistical', [DashBoardController::class, 'statistical'])->name('statistical');
    Route::get('/administrators/list/category', [\App\Http\Controllers\Admin\Category::class, 'index'])->name('Category');
    //LOẠI SẢN PHẨM
    Route::prefix('category')->group(function () {
        Route::get('/', [
            'as' => 'add.Category',
            'uses' => 'App\Http\Controllers\Admin\Category@index'
        ]);
        Route::post('/store', [
            'as' => 'store.category',
            'uses' => 'App\Http\Controllers\Admin\Category@store'
        ]);
        Route::get('/edit/{ma_loai}', [
            'as' => 'edit.category',
            'uses' => 'App\Http\Controllers\Admin\Category@edit',
        ]);
        Route::put('/update/{ma_loai}', [
            'as' => 'update.category',
            'uses' => 'App\Http\Controllers\Admin\Category@update'
        ]);
        Route::get('/destroy/{ma_loai}', [
            'as' => 'delete.category',
            'uses' => 'App\Http\Controllers\Admin\Category@destroy',
        ]);
        Route::get('/search', [
            'as' => 'search.category',
            'uses' => 'App\Http\Controllers\Admin\Category@search',
        ]);
    });


    //SẢN PHẨM 
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'add.product',
            'uses' => 'App\Http\Controllers\Admin\product@index'
        ]);
        Route::get('/show', [
            'as' => 'show.product',
            'uses' => 'App\Http\Controllers\Admin\product@show'
        ]);
        Route::post('/store', [
            'as' => 'store.product',
            'uses' => 'App\Http\Controllers\Admin\product@store'
        ]);
        Route::post('/create', [
            'as' => 'create.productBT',
            'uses' => 'App\Http\Controllers\Admin\product@create'
        ]);
        Route::get('/edit/{ma_san_pham}/{ma_bien_the}', [
            'as' => 'edit.product',
            'uses' => 'App\Http\Controllers\Admin\product@edit',
        ]);
        // Route::get('/edit/{ma_san_pham}', [
        //     'as' => 'edit.productBT',
        //     'uses' => 'App\Http\Controllers\Admin\product@edit',
        // ]);
        Route::put('/update/{ma_san_pham}', [
            'as' => 'update.productsp',
            'uses' => 'App\Http\Controllers\Admin\product@updatesp'
        ]);
        Route::put('/productvariants/{ma_bien_the}', [
            'as' => 'update.capnhatbt',
            'uses' => 'App\Http\Controllers\Admin\product@updatebt'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'destroy.product',
            'uses' => 'App\Http\Controllers\Admin\product@destroy',
        ]);
    });

    //MÀU 
    Route::prefix('color')->group(function () {
        Route::get('/show', [
            'as' => 'show.color',
            'uses' => 'App\Http\Controllers\Admin\color@show'
        ]);
        Route::get('/index', [
            'as' => 'index.color',
            'uses' => 'App\Http\Controllers\Admin\color@index'
        ]);
        Route::post('/store', [
            'as' => 'store.color',
            'uses' => 'App\Http\Controllers\Admin\color@store'
        ]);
        Route::get('/edit/{ma_mau}', [
            'as' => 'edit.color',
            'uses' => 'App\Http\Controllers\Admin\color@edit',
        ]);
        Route::put('/update/{ma_mau}', [
            'as' => 'update.color',
            'uses' => 'App\Http\Controllers\Admin\color@update'
        ]);
        Route::get('/destroy/{ma_mau}', [
            'as' => 'delete.color',
            'uses' => 'App\Http\Controllers\Admin\color@destroy',
        ]);
        Route::get('/search', [
            'as' => 'search.color',
            'uses' => 'App\Http\Controllers\Admin\color@search',
        ]);
    });

    //KÍCH THƯỚC
    Route::prefix('size')->group(function () {
        Route::get('/show', [
            'as' => 'show.size',
            'uses' => 'App\Http\Controllers\Admin\size@show'
        ]);
        Route::get('/index', [
            'as' => 'index.size',
            'uses' => 'App\Http\Controllers\Admin\size@index'
        ]);
        Route::post('/store', [
            'as' => 'store.size',
            'uses' => 'App\Http\Controllers\Admin\size@store'
        ]);
        Route::get('/edit/{ma_kich_thuoc}', [
            'as' => 'edit.size',
            'uses' => 'App\Http\Controllers\Admin\size@edit',
        ]);
        Route::put('/update/{ma_kich_thuoc}', [
            'as' => 'update.size',
            'uses' => 'App\Http\Controllers\Admin\size@update'
        ]);
        Route::get('/destroy/{ma_kich_thuoc}', [
            'as' => 'delete.size',
            'uses' => 'App\Http\Controllers\Admin\size@destroy',
        ]);
        Route::get('/search', [
            'as' => 'search.size',
            'uses' => 'App\Http\Controllers\Admin\size@search',
        ]);
    });

    //KHUYẾN MÃI
    Route::prefix('sale')->group(function () {
        Route::get('/show', [
            'as' => 'show.sale',
            'uses' => 'App\Http\Controllers\Admin\Sale@show'
        ]);
        Route::get('/index', [
            'as' => 'index.sale',
            'uses' => 'App\Http\Controllers\Admin\sale@index'
        ]);
        Route::post('/store', [
            'as' => 'store.sale',
            'uses' => 'App\Http\Controllers\Admin\sale@store'
        ]);
        Route::get('/edit/{ma_khuyen_mai}', [
            'as' => 'edit.sale',
            'uses' => 'App\Http\Controllers\Admin\sale@edit',
        ]);
        Route::put('/update/{ma_khuyen_mai}', [
            'as' => 'update.sale',
            'uses' => 'App\Http\Controllers\Admin\sale@update'
        ]);
        Route::get('/destroy/{ma_khuyen_mai}', [
            'as' => 'delete.sale',
            'uses' => 'App\Http\Controllers\Admin\sale@destroy',
        ]);
        Route::get('/search', [
            'as' => 'search.size',
            'uses' => 'App\Http\Controllers\Admin\size@search',
        ]);
    });

    //NHÂN VIÊN
    Route::prefix('employee')->group(function () {
        Route::get('/show', [
            'as' => 'show.employee',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@show'
        ]);
        Route::get('/index', [
            'as' => 'index.employee',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@index'
        ]);
        Route::post('/store', [
            'as' => 'store.employee',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@store'
        ]);
        // Route::get('/edit/{ma_kichthuoc}', [
        //     'as' => 'edit.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@edit',
        // ]);
        // Route::put('/update/{ma_kichthuoc}', [
        //     'as' => 'update.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@update'
        // ]);
        // Route::get('/destroy/{ma_kichthuoc}', [
        //     'as' => 'delete.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@destroy',
        // ]);
        Route::get('/search', [
            'as' => 'search.employee',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@search',
        ]);
        Route::get('/administrators/details/employees/{ma_nhan_vien}', [
            'as' => 'detail.employee',
            'uses' => 'App\Http\Controllers\Admin\AdminUserController@detail',
        ]);
    });

    //đơn hàng
    Route::prefix('order')->group(function () {

        Route::get('/index/{ma_don_hang}', [
            'as' => 'index.order',
            'uses' => 'App\Http\Controllers\Admin\Orders@index'
        ]);
        // Route::post('/store', [
        //     'as' => 'store.employee',
        //     'uses' => 'App\Http\Controllers\Admin\AdminUserController@store'
        // ]);
        // Route::get('/edit/{ma_kichthuoc}', [
        //     'as' => 'edit.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@edit',
        // ]);
        // Route::put('/update/{ma_kichthuoc}', [
        //     'as' => 'update.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@update'
        // ]);
        // Route::get('/destroy/{ma_kichthuoc}', [
        //     'as' => 'delete.size',
        //     'uses' => 'App\Http\Controllers\Admin\size@destroy',
        // ]);
        // Route::get('/search', [
        //     'as' => 'search.employee',
        //     'uses' => 'App\Http\Controllers\Admin\AdminUserController@search',
        // ]);
        // Route::get('/administrators/details/employees/{ma_nhan_vien}', [
        //     'as' => 'detail.employee',
        //     'uses' => 'App\Http\Controllers\Admin\AdminUserController@detail',
        // ]);
    });
});




Route::get('/customer/maininterface/{luot_xem?}/{ma_loai?}', 'App\Http\Controllers\Customer\InterfaceMain@indexMain')->name('maininterface');
Route::get('/customer/product/{ma_loai?}', 'App\Http\Controllers\Customer\InterfaceMain@indexPro')->name('product');
Route::get('/search', 'App\Http\Controllers\Customer\InterfaceMain@searchde')->name('search');
Route::get('/detail/{ma_san_pham}', 'App\Http\Controllers\Customer\InterfaceMain@indexdetail')->name('detail');
Route::get('/increase-view/{ma_san_pham}', 'App\Http\Controllers\Customer\InterfaceMain@increaseView')->name('increase-view');

Route::post('/head', 'App\Http\Controllers\Customer\InterfaceMain@head')->name('head');



// KHÁCH HÀNG
Route::prefix('customer')->group(function () {
    Route::get('/signup', [
        'as' => 'index.signup',
        'uses' => 'App\Http\Controllers\Customer\signup@index'
    ]);
    Route::post('/store', [
        'as' => 'store.signup',
        'uses' => 'App\Http\Controllers\Customer\signup@store'
    ]);
    Route::get('/info/{ma_khach_hang}', [
        'as' => 'show.signup',
        'uses' => 'App\Http\Controllers\Customer\signup@show'
    ]);
    Route::put('/updated/{ma_khach_hang}', [
        'as' => 'update.customer',
        'uses' => 'App\Http\Controllers\Customer\signup@update'
    ]);
    Route::put('/updatemk/{ma_khach_hang}', [
        'as' => 'updatemk.customer',
        'uses' => 'App\Http\Controllers\Customer\signup@updatemk'
    ]);
});


Route::post('/addcart', 'App\Http\Controllers\Customer\OrderController@addcart')->name('addToCart');
Route::get('/cart', 'App\Http\Controllers\Customer\OrderController@Cartindex')->name('cart.index');
Route::post('/buynow', 'App\Http\Controllers\Customer\OrderController@buynow')->name('buyNow');
Route::post('/update-cart', 'App\Http\Controllers\Customer\OrderController@updateCartQuantity')->name('cart.update');
Route::get('/cart/delete/{bien_the}', 'App\Http\Controllers\Customer\OrderController@delete')->name('cart.delete');
Route::get('/order', 'App\Http\Controllers\Customer\OrderController@indexOder')->name('order.index');
Route::get('/apply-voucher', 'App\Http\Controllers\Customer\OrderController@applyVoucher');
Route::post('/place-order', 'App\Http\Controllers\Customer\OrderController@storeOrder')->name('order.place');
Route::get('/payment/callback', 'App\Http\Controllers\Customer\OrderController@callback')->name('payment.callback');
Route::delete('/orders/{ma_don_hang}', 'App\Http\Controllers\Customer\OrderController@cancelOrder')->name('cancel.order');
