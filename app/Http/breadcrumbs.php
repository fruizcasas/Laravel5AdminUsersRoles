<?php

/*
|--------------------------------------------------------------------------
| home Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

/*
|--------------------------------------------------------------------------
| home / profile Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('profile', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('profile.edit'));
});

/*
|--------------------------------------------------------------------------
| home / admin Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('admin', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Admin', route('admin.index'));
});

/*
|--------------------------------------------------------------------------
| home / admin / users Breadcrumb
|--------------------------------------------------------------------------
*/
Breadcrumbs::register('admin.users', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Users', route('admin.users.index'));
});

// Home > Admin -> Users -> Create
Breadcrumbs::register('admin.users.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push('Create', route('admin.users.create'));
});

// Home > Admin -> Users -> Edit
Breadcrumbs::register('admin.users.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push('Edit', route('admin.users.edit'));
});

// Home > Admin -> Users -> Show
Breadcrumbs::register('admin.users.show', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push('Show', route('admin.users.show'));
});

/*
|--------------------------------------------------------------------------
| home / admin / roles Breadcrumb
|--------------------------------------------------------------------------
*/

// Home > Admin -> Roles
Breadcrumbs::register('admin.roles', function($breadcrumbs)
{
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Roles', route('admin.roles.index'));
});

// Home > Admin -> roles -> Create
Breadcrumbs::register('admin.roles.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push('Create', route('admin.roles.create'));
});

// Home > Admin -> roles -> Edit
Breadcrumbs::register('admin.roles.edit', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push('Edit', route('admin.roles.edit'));
});

// Home > Admin -> roles -> Show
Breadcrumbs::register('admin.roles.show', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.roles');
    $breadcrumbs->push('Show', route('admin.roles.show'));
});


