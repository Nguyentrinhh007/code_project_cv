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

//  -----------------------BACKEND-------------------

// -- LOGIN --
Route::get('login','backend\LoginController@getLogin')->middleware('CheckLogout');
Route::post('login','backend\LoginController@postLogin');

// -- ADMIN --

Route::group(['prefix' => 'admin','middleware' => 'CheckLogin'], function () {
    Route::get('','backend\LoginController@getIndex');
    Route::get('logout','backend\LoginController@getLogout');

    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','backend\CategoryController@getCategory');
        Route::post('','backend\CategoryController@postAddCategory' );

        Route::get('edit/{id}','backend\CategoryController@editCategory');
        Route::post('edit/{id}','backend\CategoryController@postEditCategory');

        Route::get('del/{id}','backend\CategoryController@delCategory');
    });

    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('','backend\ProductController@listProduct');

        Route::get('add','backend\ProductController@addProduct');
        Route::post('add','backend\ProductController@postAddProduct');

        Route::get('edit/{id}','backend\ProductController@editProduct');
        Route::post('edit/{id}','backend\ProductController@postEditProduct');

        Route::get('del/{id}','backend\ProductController@delProduct');

   //thêm thuộc tính
        Route::get('attr','backend\ProductController@getAttr');
        Route::post('add_attr','backend\ProductController@postAddAttr');
    //sửa thuộc tính
        Route::get('edit_attr/{id}','backend\ProductController@editAttr');
        Route::post('edit_attr/{id}','backend\ProductController@postEditAttr');

    //xóa thuộc tính
        Route::get('del_attr/{id}','backend\ProductController@delAttr');

    //thêm giá trị thuộc tính
        Route::post('add_value','backend\ProductController@addValue');
  //sửa GIÁ TRỊ thuộc tính
        Route::get('edit_value/{id}','backend\ProductController@editValue');
        Route::post('edit_value/{id}','backend\ProductController@postEditValue');
        Route::get('del_value/{id}','backend\ProductController@delValue');

        Route::get('add_variant/{id}','backend\ProductController@addVariant');
        Route::post('add_variant/{id}','backend\ProductController@postAddVariant');

        Route::get('edit_variant/{id}','backend\ProductController@editVariant');
        Route::post('edit_variant/{id}','backend\ProductController@postEditVariant');

        Route::get('del_variant/{id}','backend\ProductController@delVariant');
    });

        //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('','backend\OrderController@listOrder');
        Route::get('detail/{customer_id}','backend\OrderController@detailOrder');
        Route::get('active/{customer_id}','backend\OrderController@ActiveOrder');
        Route::get('processed','backend\OrderController@Processed');
    });

    // user
    Route::group(['prefix' => 'user'], function () {
        Route::get('','backend\UserController@listUser');

        Route::get('add','backend\UserController@addUser');
        Route::post('add','backend\UserController@postAddUser');

        Route::get('edit','backend\UserController@editUser');
        Route::post('edit','backend\UserController@editPostUser');

    });



});



//  -----------------------FRONTEND-------------------

//frontend
Route::get('','frontend\HomeController@GetHome');
Route::get('contact','frontend\HomeController@GetContact');
Route::get('about','frontend\HomeController@GetAbout');
Route::group(['prefix' => 'product'], function () {
    Route::get('','frontend\ProductController@ListProduct');
    Route::get('detail/{id}','frontend\ProductController@DetailProduct');

    Route::get('cart','frontend\ProductController@GetCart');
    Route::get('add_cart','frontend\ProductController@AddCart');

    Route::get('removecart/{id}','frontend\ProductController@RemoveCart');
    Route::get('updatecart/{rowId}/{qty}','frontend\ProductController@UpdateCart');

    Route::get('checkout','frontend\ProductController@CheckOut');
    Route::post('checkout','frontend\ProductController@PostCheckOut');

    Route::get('complete/{id_customer}','frontend\ProductController@complete');
});
