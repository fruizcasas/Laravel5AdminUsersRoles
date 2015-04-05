<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',
    [
        'as' => 'welcome', 'uses' => 'WelcomeController@index'
    ]);

Route::get('home',
    [
        'as' => 'home', 'uses' => 'HomeController@index'
    ]);

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('profile',
    [
        'as' => 'profile.edit', 'uses' => 'ProfileController@edit'
    ]);

Route::put('profile',
    [
        'as' => 'profile.update', 'uses' => 'ProfileController@update'
    ]);

Route::get('profile/settrash/{route?}',
    [
        'as' => 'profile.settrash', 'uses' => 'ProfileController@setTrash'
    ]);

Route::get('profile/resettrash/{route?}',
    [
        'as' => 'profile.resettrash', 'uses' => 'ProfileController@resetTrash'
    ]);


/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/

Route::get('owner',
    [
        'as' => 'owner.index', 'uses' => 'OwnerController@index'
    ]);

Route::get('reviewer',
    [
        'as' => 'reviewer.index', 'uses' => 'ReviewerController@index'
    ]);

Route::get('approver',
    [
        'as' => 'approver.index', 'uses' => 'ApproverController@index'
    ]);

Route::get('signer',
    [
        'as' => 'signer.index', 'uses' => 'SignerController@index'
    ]);

/*
|--------------------------------------------------------------------------
| Admin namespace
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'admin'
    ],
    function () {

        /*
        |--------------------------------------------------------------------------
        | Admin/Users Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/',
            [
                'as' => 'admin.index', 'uses' => 'MainController@index'
            ]);


        Route::post('/users/filter',
            [
                'as' => 'admin.users.filter',
                'uses' => 'UsersController@filter'
            ]);

        Route::get('/users/sort/{column?}/{order?}',
            [
                'as' => 'admin.users.sort',
                'uses' => 'UsersController@sort'
            ]);

        Route::delete('/users/{users}/forcedelete',
            [
                'as' => 'admin.users.forcedelete',
                'uses' => 'UsersController@forcedelete'
            ]);

        Route::post('/users/{users}/restore',
            [
                'as' => 'admin.users.restore',
                'uses' => 'UsersController@restore'
            ]);

        Route::resource('/users', 'UsersController');

        /*
        |--------------------------------------------------------------------------
        | Admin/Roles Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/roles/filter',
            [
                'as' => 'admin.roles.filter',
                'uses' => 'RolesController@filter'
            ]);

        Route::get('/roles/sort/{column?}/{order?}',
            [
                'as' => 'admin.roles.sort',
                'uses' => 'RolesController@sort'
            ]);

        Route::delete('/roles/{roles}/forcedelete',
            [
                'as' => 'admin.roles.forcedelete',
                'uses' => 'RolesController@forcedelete'
            ]);

        Route::post('/roles/{roles}/restore',
            [
                'as' => 'admin.roles.restore',
                'uses' => 'RolesController@restore'
            ]);

        Route::resource('/roles', 'RolesController');


    });

/*
|--------------------------------------------------------------------------
| Auth/Password Routes
|--------------------------------------------------------------------------
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
