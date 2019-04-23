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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
        'prefix'=>'admin',
        'namespace'=>'Admin',
        'middleware'=>'checkPermission'
    ],

    function(){
        Route::get('/', 'DefaultController@index')->name('admin_home');

        /*用户*/
        Route::get('/user', 'UserController@index')->name('admin_user');
        Route::get('/user/create', 'UserController@create')->name('admin_user_create');
        Route::post('/user/store', 'UserController@store')->name('admin_user_store');
        Route::get('/user/{id}/role', 'UserController@role')->name('admin_user_role');
        Route::post('/user/{id}/role/store', 'UserController@storeRole')->name('admin_user_role_store');

        /*角色*/
        Route::get('/setting/role', 'RoleController@index')->name('admin_role');
        Route::get('/setting/role/create', 'RoleController@create')->name('admin_role_create');
        Route::post('/setting/role/store', 'RoleController@store')->name('admin_role_store');
        Route::get('/setting/role/{id}/ability', 'RoleController@ability')->name('admin_role_ability');
        Route::post('/setting/role/{id}/ability/store', 'RoleController@storeAbility')->name('admin_role_ability_store');

        /*权限*/
        Route::get('/setting/ability', 'AbilityController@index')->name('admin_ability');
        Route::get('/setting/ability/create', 'abilityController@create')->name('admin_ability_create');
        Route::post('/setting/ability/store', 'abilityController@store')->name('admin_ability_store');

        /*数据字典*/
        Route::get('/setting/dictionary', 'DictionaryController@index')->name('admin_dictionary');
        Route::get('/setting/dictionary/create', 'DictionaryController@create')->name('admin_dictionary_create');
        Route::post('/setting/dictionary/store', 'DictionaryController@store')->name('admin_dictionary_store');
});
