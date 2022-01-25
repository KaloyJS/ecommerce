<?php

$router = new AltoRouter();

//admin routes 
$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@show', 'admin_dashboard');
$router->map('POST', '/admin', 'App\Controllers\Admin\DashboardController@get', 'admin_form');

//product management
$router->map(
    'GET',
    '/admin/product/categories',
    'App\Controllers\Admin\ProductCategoryController@show',
    'product_category'
);
$router->map(
    'POST',
    '/admin/product/categories',
    'App\Controllers\Admin\ProductCategoryController@store',
    'create_product_category'
);

$router->map(
    'POST',
    '/admin/product/categories/[i:id]/edit',
    'App\Controllers\Admin\ProductCategoryController@edit',
    'edit_product_category'
);

$router->map(
    'POST',
    '/admin/product/categories/[i:id]/delete',
    'App\Controllers\Admin\ProductCategoryController@delete',
    'delete_product_category'
);

//subcategory
$router->map(
    'POST',
    '/admin/product/subcategories/create',
    'App\Controllers\Admin\SubCategoryController@store',
    'create_subcategory'
);

$router->map(
    'POST',
    '/admin/product/subcategories/[i:id]/edit',
    'App\Controllers\Admin\SubCategoryController@edit',
    'edit_subcategory'
);

$router->map(
    'POST',
    '/admin/product/subcategories/[i:id]/delete',
    'App\Controllers\Admin\SubCategoryController@delete',
    'delete_subcategory'
);