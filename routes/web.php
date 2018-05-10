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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin','AdminController@login');
Route::match(['get','post'],'/admin','AdminController@login' );
route::get('/admin/logout','AdminController@logout');

Auth::routes();
Route::group(['middleware' => ['auth']],function(){
	route::get('/admin/dashboard','AdminController@dashboard');
	route::get('/admin/settings','AdminController@settings');
	route::get('/admin/check-pwd','AdminController@chkpassword');
    Route::match(['get','post'],'/admin/update-pwd','AdminController@updatepassword' );

//categories Rutes 

    Route::match(['get','post'],'/admin/add-category','CategoryController@addCategories' );
    Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@edit_category' );
    Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@delete_category' );
    Route::get('/admin/view-categories','CategoryController@view_categories' );

//Product Routes
    Route::match(['get','post'],'/admin/add-product','ProductsController@add_Product' );
    Route::get('/admin/view-products','ProductsController@View_Products' );
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@Edit_Product' );
    Route::get('/admin/delete-product/{id}','ProductsController@Delete_Product' );
    Route::get('/admin/delete-product-image/{id}','ProductsController@Delete_Product_Image' );

});


Route::get('/home', 'HomeController@index')->name('home');
