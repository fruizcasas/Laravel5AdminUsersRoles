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
| Locale Routes
|--------------------------------------------------------------------------
*/

Route::get('locale/{locale?}',
    [
        'as' => 'locale.setlocale',
        'uses' => 'LocaleController@setLocale'
    ]);

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('profile',
    [
        'as' => 'profile.edit',
        'uses' => 'ProfileController@edit',
        'middleware' => 'auth'
    ]);

Route::put('profile',
    [
        'as' => 'profile.update',
        'uses' => 'ProfileController@update',
        'middleware' => 'auth'
    ]);

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::get('password',
    [
        'as' => 'password.edit',
        'uses' => 'PasswordController@edit',
        'middleware' => 'auth'
    ]);

Route::put('password',
    [
        'as' => 'password.update',
        'uses' => 'PasswordController@update',
        'middleware' => 'auth'
    ]);


/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/

Route::get('author',
    [
        'as' => 'author.index', 'uses' => 'AuthorController@index'
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
        'as' => 'publisher.index', 'uses' => 'PublisherController@index'
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

        Route::get('/users/excel',
            [
                'as' => 'admin.users.excel',
                'uses' => 'UsersController@excel'
            ]);

        Route::get('/users/trash/{trash?}',
            [
                'as' => 'admin.users.trash',
                'uses' => 'UsersController@trash'
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

        Route::get('/users/{users}/edit/password',
            [
                'as' => 'admin.users.edit_password',
                'uses' => 'UsersController@edit_password'
            ]);

        Route::put('/users/{users}/password',
            [
                'as' => 'admin.users.update_password',
                'uses' => 'UsersController@update_password'
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

        Route::get('/roles/excel',
            [
                'as' => 'admin.roles.excel',
                'uses' => 'RolesController@excel'
            ]);


        Route::get('/roles/trash/{trash?}',
            [
                'as' => 'admin.roles.trash',
                'uses' => 'RolesController@trash'
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

        /*
        |--------------------------------------------------------------------------
        | Admin/Permissions Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/permissions/filter',
            [
                'as' => 'admin.permissions.filter',
                'uses' => 'PermissionsController@filter'
            ]);

        Route::get('/permissions/excel',
            [
                'as' => 'admin.permissions.excel',
                'uses' => 'PermissionsController@excel'
            ]);


        Route::get('/permissions/trash/{trash?}',
            [
                'as' => 'admin.permissions.trash',
                'uses' => 'PermissionsController@trash'
            ]);

        Route::get('/permissions/sort/{column?}/{order?}',
            [
                'as' => 'admin.permissions.sort',
                'uses' => 'PermissionsController@sort'
            ]);

        Route::delete('/permissions/{permissions}/forcedelete',
            [
                'as' => 'admin.permissions.forcedelete',
                'uses' => 'PermissionsController@forcedelete'
            ]);

        Route::post('/permissions/{permissions}/restore',
            [
                'as' => 'admin.permissions.restore',
                'uses' => 'PermissionsController@restore'
            ]);

        Route::resource('/permissions', 'PermissionsController');

        /*
|--------------------------------------------------------------------------
| Admin/Fileentries Routes
|--------------------------------------------------------------------------
*/

        Route::post('/fileentries/filter',
            [
                'as' => 'admin.fileentries.filter',
                'uses' => 'FileentriesController@filter'
            ]);

        Route::get('/fileentries/excel',
            [
                'as' => 'admin.fileentries.excel',
                'uses' => 'FileentriesController@excel'
            ]);


        Route::get('/fileentries/trash/{trash?}',
            [
                'as' => 'admin.fileentries.trash',
                'uses' => 'FileentriesController@trash'
            ]);

        Route::get('/fileentries/sort/{column?}/{order?}',
            [
                'as' => 'admin.fileentries.sort',
                'uses' => 'FileentriesController@sort'
            ]);

        Route::delete('/fileentries/{fileentries}/forcedelete',
            [
                'as' => 'admin.fileentries.forcedelete',
                'uses' => 'FileentriesController@forcedelete'
            ]);

        Route::post('/fileentries/{fileentries}/restore',
            [
                'as' => 'admin.fileentries.restore',
                'uses' => 'FileentriesController@restore'
            ]);

        Route::get('/fileentries/get/{fileentries}',
            [
                'as' => 'admin.fileentries.get',
                'uses' => 'FileentriesController@get'
            ]);

        Route::get('/fileentries/download/{fileentries}',
            [
                'as' => 'admin.fileentries.download',
                'uses' => 'FileentriesController@download'
            ]);


        Route::resource('/fileentries', 'FileentriesController');



        /*
        |--------------------------------------------------------------------------
        | Admin/Departments Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/departments/filter',
            [
                'as' => 'admin.departments.filter',
                'uses' => 'DepartmentsController@filter'
            ]);

        Route::get('/departments/excel',
            [
                'as' => 'admin.departments.excel',
                'uses' => 'DepartmentsController@excel'
            ]);

        Route::get('/departments/trash/{trash?}',
            [
                'as' => 'admin.departments.trash',
                'uses' => 'DepartmentsController@trash'
            ]);

        Route::get('/departments/sort/{column?}/{order?}',
            [
                'as' => 'admin.departments.sort',
                'uses' => 'DepartmentsController@sort'
            ]);

        Route::delete('/departments/{departments}/forcedelete',
            [
                'as' => 'admin.departments.forcedelete',
                'uses' => 'DepartmentsController@forcedelete'
            ]);

        Route::post('/departments/{departments}/restore',
            [
                'as' => 'admin.departments.restore',
                'uses' => 'DepartmentsController@restore'
            ]);

        Route::resource('/departments', 'DepartmentsController');

        /*
        |--------------------------------------------------------------------------
        | Admin/Folders Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/folders/filter',
            [
                'as' => 'admin.folders.filter',
                'uses' => 'FoldersController@filter'
            ]);

        Route::get('/folders/excel',
            [
                'as' => 'admin.folders.excel',
                'uses' => 'FoldersController@excel'
            ]);

        Route::get('/folders/trash/{trash?}',
            [
                'as' => 'admin.folders.trash',
                'uses' => 'FoldersController@trash'
            ]);

        Route::get('/folders/sort/{column?}/{order?}',
            [
                'as' => 'admin.folders.sort',
                'uses' => 'FoldersController@sort'
            ]);

        Route::delete('/folders/{folders}/forcedelete',
            [
                'as' => 'admin.folders.forcedelete',
                'uses' => 'FoldersController@forcedelete'
            ]);

        Route::post('/folders/{folders}/restore',
            [
                'as' => 'admin.folders.restore',
                'uses' => 'FoldersController@restore'
            ]);

        Route::resource('/folders', 'FoldersController');

        /*
        |--------------------------------------------------------------------------
        | Admin/Categories Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/categories/filter',
            [
                'as' => 'admin.categories.filter',
                'uses' => 'CategoriesController@filter'
            ]);

        Route::get('/categories/excel',
            [
                'as' => 'admin.categories.excel',
                'uses' => 'CategoriesController@excel'
            ]);

        Route::get('/categories/trash/{trash?}',
            [
                'as' => 'admin.categories.trash',
                'uses' => 'CategoriesController@trash'
            ]);

        Route::get('/categories/sort/{column?}/{order?}',
            [
                'as' => 'admin.categories.sort',
                'uses' => 'CategoriesController@sort'
            ]);

        Route::delete('/categories/{categories}/forcedelete',
            [
                'as' => 'admin.categories.forcedelete',
                'uses' => 'CategoriesController@forcedelete'
            ]);

        Route::post('/categories/{categories}/restore',
            [
                'as' => 'admin.categories.restore',
                'uses' => 'CategoriesController@restore'
            ]);

        Route::resource('/categories', 'CategoriesController');

        /*
        |--------------------------------------------------------------------------
        | Admin/Documents Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/documents/filter',
            [
                'as' => 'admin.documents.filter',
                'uses' => 'DocumentsController@filter'
            ]);

        Route::get('/documents/excel',
            [
                'as' => 'admin.documents.excel',
                'uses' => 'DocumentsController@excel'
            ]);

        Route::get('/documents/trash/{trash?}',
            [
                'as' => 'admin.documents.trash',
                'uses' => 'DocumentsController@trash'
            ]);

        Route::get('/documents/sort/{column?}/{order?}',
            [
                'as' => 'admin.documents.sort',
                'uses' => 'DocumentsController@sort'
            ]);

        Route::delete('/documents/{documents}/forcedelete',
            [
                'as' => 'admin.documents.forcedelete',
                'uses' => 'DocumentsController@forcedelete'
            ]);

        Route::post('/documents/{documents}/restore',
            [
                'as' => 'admin.documents.restore',
                'uses' => 'DocumentsController@restore'
            ]);

        Route::resource('/documents', 'DocumentsController');

        /*
        |--------------------------------------------------------------------------
        | Admin/Frontpages Routes
        |--------------------------------------------------------------------------
        */

        Route::post('/frontpages/filter',
            [
                'as' => 'admin.frontpages.filter',
                'uses' => 'FrontpagesController@filter'
            ]);

        Route::get('/frontpages/excel',
            [
                'as' => 'admin.frontpages.excel',
                'uses' => 'FrontpagesController@excel'
            ]);

        Route::get('/frontpages/trash/{trash?}',
            [
                'as' => 'admin.frontpages.trash',
                'uses' => 'FrontpagesController@trash'
            ]);

        Route::get('/frontpages/sort/{column?}/{order?}',
            [
                'as' => 'admin.frontpages.sort',
                'uses' => 'FrontpagesController@sort'
            ]);

        Route::delete('/frontpages/{frontpages}/forcedelete',
            [
                'as' => 'admin.frontpages.forcedelete',
                'uses' => 'FrontpagesController@forcedelete'
            ]);

        Route::post('/frontpages/{frontpages}/restore',
            [
                'as' => 'admin.frontpages.restore',
                'uses' => 'FrontpagesController@restore'
            ]);

        Route::resource('/frontpages', 'FrontpagesController');


        /*
        |--------------------------------------------------------------------------
        | Fileentries Routes
        |--------------------------------------------------------------------------
        */

        Route::get('files',
            [
                'as' => 'fileentries.edit',
                'uses' => 'FileentriesController@index',
                'middleware' => 'admin'
            ]);

        Route::post('files',
            [
                'as' => 'fileentries.store',
                'uses' => 'FileentriesController@store',
                'middleware' => 'admin'
            ]);

        Route::put('files/{$files}',
            [
                'as' => 'fileentries.update',
                'uses' => 'FileentriesController@update',
                'middleware' => 'admin'
            ]);

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
