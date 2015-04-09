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



