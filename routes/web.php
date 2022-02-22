<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/dashboard', 'HomeController@index')->name('dashboard');


        //==============================Category============================
        Route::group(['namespace' => 'Category'], function () {
            Route::resource('categories', 'CategoryControler')->except(['show']);
            Route::get('/search', 'CategoryControler@search')->name('search');
        });

        //==============================Products============================
        Route::group(['namespace' => 'Product'], function () {
            Route::resource('products', 'ProductController')->except(['show']);
        });

        //==============================clients============================
        Route::group(['namespace' => 'Client'], function () {
            Route::resource('clients', 'ClientController')->except(['show']);
            //     Route::resource('clients.orders', 'Clients\OrderController')->except(['show']);
        });

        //==============================clients============================
        Route::group(['namespace' => 'Clients'], function () {

            Route::resource('clients.orders', 'OrderController')->except(['show']);
        });

        //==============================Order============================
        Route::group(['namespace' => 'Order'], function () {
            Route::resource('orders', 'OrderController');
            Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');
        });

        Route::group(['middleware' => ['auth']], function () {
            Route::resource('roles', 'RoleController');
            Route::resource('users', 'UserController');
        });
    }
);