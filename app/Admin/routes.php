<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    Route::resource('employee', EmployeeController::class);
    Route::resource('employee-access-tool', EmployeeAccessToolController::class);
    Route::resource('employee-sign', EmployeeSignController::class);
    Route::resource('employee-resign', EmployeeResignController::class);
    $router->get('create', [EmployeeResignController::class, 'create']);



});
