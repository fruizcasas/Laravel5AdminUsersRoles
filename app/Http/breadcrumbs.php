<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'breadcrumbs.';


/*
|--------------------------------------------------------------------------
| home Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('home', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->push(trans($VN.'home'), route('home'));
});

/*
|--------------------------------------------------------------------------
| home / profile Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('profile', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans($VN.'profile'), route('profile.edit'));
});

/*
|--------------------------------------------------------------------------
| home / password Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('password', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans($VN.'password'), route('password.edit'));
});


/*
|--------------------------------------------------------------------------
| home / admin Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('admin', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans($VN.'admin'), route('admin.index'));
});

/*
|--------------------------------------------------------------------------
| home / admin / users Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('admin.users', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'users'), route('admin.users.index'));
});

// Home > Admin -> Users -> Create
Breadcrumbs::register('admin.users.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push(trans($VN.'create'), route('admin.users.create'));
});

// Home > Admin -> Users -> Edit
Breadcrumbs::register('admin.users.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.users.edit'));
});

// Home > Admin -> Users -> Show
Breadcrumbs::register('admin.users.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push(trans($VN.'show'), route('admin.users.show'));
});

// Home > Admin -> Passwords -> Edit
Breadcrumbs::register('admin.users.password', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push(trans($VN.'password'), route('admin.users.edit_password'));
});


/*
|--------------------------------------------------------------------------
| home / admin / roles Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Roles
Breadcrumbs::register('admin.roles', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'roles'), route('admin.roles.index'));
});

// Home > Admin -> roles -> Create
Breadcrumbs::register('admin.roles.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push(trans($VN.'create'), route('admin.roles.create'));
});

// Home > Admin -> roles -> Edit
Breadcrumbs::register('admin.roles.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.roles.edit'));
});

// Home > Admin -> roles -> Show
Breadcrumbs::register('admin.roles.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push(trans($VN.'show'), route('admin.roles.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / permissions Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Permissions
Breadcrumbs::register('admin.permissions', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'permissions'), route('admin.permissions.index'));
});

// Home > Admin -> permissions -> Create
Breadcrumbs::register('admin.permissions.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.permissions');
    $breadcrumbs->push(trans($VN.'create'), route('admin.permissions.create'));
});

// Home > Admin -> permissions -> Edit
Breadcrumbs::register('admin.permissions.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.permissions');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.permissions.edit'));
});

// Home > Admin -> permissions -> Show
Breadcrumbs::register('admin.permissions.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.permissions');
    $breadcrumbs->push(trans($VN.'show'), route('admin.permissions.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / fileentries Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Fileentries
Breadcrumbs::register('admin.fileentries', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'fileentries'), route('admin.fileentries.index'));
});

// Home > Admin -> fileentries -> Create
Breadcrumbs::register('admin.fileentries.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.fileentries');
    $breadcrumbs->push(trans($VN.'create'), route('admin.fileentries.create'));
});

// Home > Admin -> fileentries -> Edit
Breadcrumbs::register('admin.fileentries.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.fileentries');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.fileentries.edit'));
});

// Home > Admin -> fileentries -> Show
Breadcrumbs::register('admin.fileentries.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.fileentries');
    $breadcrumbs->push(trans($VN.'show'), route('admin.fileentries.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / departments Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Departments
Breadcrumbs::register('admin.departments', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'departments'), route('admin.departments.index'));
});

// Home > Admin -> departments -> Create
Breadcrumbs::register('admin.departments.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.departments');
    $breadcrumbs->push(trans($VN.'create'), route('admin.departments.create'));
});

// Home > Admin -> departments -> Edit
Breadcrumbs::register('admin.departments.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.departments');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.departments.edit'));
});

// Home > Admin -> departments -> Show
Breadcrumbs::register('admin.departments.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.departments');
    $breadcrumbs->push(trans($VN.'show'), route('admin.departments.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / categories Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Categories
Breadcrumbs::register('admin.categories', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'categories'), route('admin.categories.index'));
});

// Home > Admin -> categories -> Create
Breadcrumbs::register('admin.categories.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push(trans($VN.'create'), route('admin.categories.create'));
});

// Home > Admin -> categories -> Edit
Breadcrumbs::register('admin.categories.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.categories.edit'));
});

// Home > Admin -> categories -> Show
Breadcrumbs::register('admin.categories.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push(trans($VN.'show'), route('admin.categories.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / folders Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Folders
Breadcrumbs::register('admin.folders', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'folders'), route('admin.folders.index'));
});

// Home > Admin -> folders -> Create
Breadcrumbs::register('admin.folders.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.folders');
    $breadcrumbs->push(trans($VN.'create'), route('admin.folders.create'));
});

// Home > Admin -> folders -> Edit
Breadcrumbs::register('admin.folders.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.folders');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.folders.edit'));
});

// Home > Admin -> folders -> Show
Breadcrumbs::register('admin.folders.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.folders');
    $breadcrumbs->push(trans($VN.'show'), route('admin.folders.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / documents Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Documents
Breadcrumbs::register('admin.documents', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'documents'), route('admin.documents.index'));
});

// Home > Admin -> documents -> Create
Breadcrumbs::register('admin.documents.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.documents');
    $breadcrumbs->push(trans($VN.'create'), route('admin.documents.create'));
});

// Home > Admin -> documents -> Edit
Breadcrumbs::register('admin.documents.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.documents');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.documents.edit'));
});

// Home > Admin -> documents -> Show
Breadcrumbs::register('admin.documents.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.documents');
    $breadcrumbs->push(trans($VN.'show'), route('admin.documents.show'));
});




/*
|--------------------------------------------------------------------------
| home / admin / frontpages Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Frontpages
Breadcrumbs::register('admin.frontpages', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push(trans($VN.'frontpages'), route('admin.frontpages.index'));
});

// Home > Admin -> frontpages -> Create
Breadcrumbs::register('admin.frontpages.create', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.frontpages');
    $breadcrumbs->push(trans($VN.'create'), route('admin.frontpages.create'));
});

// Home > Admin -> frontpages -> Edit
Breadcrumbs::register('admin.frontpages.edit', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.frontpages');
    $breadcrumbs->push(trans($VN.'edit'), route('admin.frontpages.edit'));
});

// Home > Admin -> frontpages -> Show
Breadcrumbs::register('admin.frontpages.show', function($breadcrumbs) use ($VN)
{
    $breadcrumbs->parent('admin.frontpages');
    $breadcrumbs->push(trans($VN.'show'), route('admin.frontpages.show'));
});








