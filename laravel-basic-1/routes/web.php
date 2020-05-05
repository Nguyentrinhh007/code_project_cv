<?php

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

//  FRONTEND
Route::get('', 'frontend\IndexController@GetIndex');
Route::get('about', 'frontend\IndexController@GetAbout');
Route::get('contact', 'frontend\IndexController@GetContact');

Route::get('{slug_cate}.html', 'frontend\IndexController@GetPrdSlug');
Route::get('filter', 'frontend\IndexController@GetFilter');

//product
Route::group(['prefix' => 'product'], function() {
    Route::get('{slug_prd}.html', 'frontend\ProductController@GetDetail');
    Route::get('shop', 'frontend\ProductController@GetShop');
});

//checkout
Route::group(['prefix' => 'checkout'], function() {
    Route::get('', 'frontend\CheckOutController@GetCheckOut');
    Route::post('', 'frontend\CheckOutController@PostCheckOut');

    Route::get('complete/{order_id}', 'frontend\CheckOutController@GetComplete');
});

// cart
Route::group(['prefix' => 'cart'], function() {
    Route::get('', 'frontend\CartController@GetCart');
    Route::get('add', 'frontend\CartController@AddCart');

    Route::get('update/{rowId}/{qty}', 'frontend\CartController@UpdateCart');
    Route::get('del/{rowId}', 'frontend\CartController@DelCart');
});

// BACKEND
Route::get('login', 'backend\LoginController@GetLogin')->middleware('CheckLogout');
Route::post('login', 'backend\LoginController@PostLogin');

Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function() {
    Route::get('', 'backend\IndexController@GetIndex');
    Route::get('logout', 'backend\IndexController@GetLogout');

    //category
    
    Route::group(['prefix' => 'category'], function() {
        Route::get('', 'backend\CategoryController@GetCategory');
        Route::post('', 'backend\CategoryController@PostCategory');

        Route::get('edit/{id}', 'backend\CategoryController@GetEditCategory');
        Route::post('edit/{id}', 'backend\CategoryController@PostEditCategory');

        Route::get('del/{id}', 'backend\CategoryController@DelCategory');

    });

    //product
    Route::group(['prefix' => 'product'], function() {
        Route::get('', 'backend\ProductController@ListProduct');

        Route::get('add', 'backend\ProductController@GetAddProduct');
        Route::post('add', 'backend\ProductController@PostAddProduct');
       
        Route::get('edit/{id}', 'backend\ProductController@GetEditProduct');
        Route::post('edit/{id}', 'backend\ProductController@PostEditProduct');

        Route::get('del/{id}', 'backend\ProductController@DelProduct');

    });

    //user
    Route::group(['prefix' => 'user'], function() {
        Route::get('', 'backend\UserController@ListUser');

        Route::get('add', 'backend\UserController@GetAddUser');
        Route::post('add', 'backend\UserController@PostAddUser');

        Route::get('edit/{id_user}', 'backend\UserController@GetEditUser');
        Route::post('edit/{id_user}', 'backend\UserController@PostEditUser');

        Route::get('del/{id_user}', 'backend\UserController@DelUser');

    });

    //order
    Route::group(['prefix' => 'order'], function() {
        Route::get('', 'backend\OrderController@ListOrder');
        Route::get('detail/{id_order}', 'backend\OrderController@DetailOrder');
        Route::get('paid/{id_order}', 'backend\OrderController@Paid');
        Route::get('processed', 'backend\OrderController@ProcessedOrder');
    });
    
});





