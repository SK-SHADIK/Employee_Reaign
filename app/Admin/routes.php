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
    Route::resource('approval-status', ApprovalStatusController::class);
    Route::resource('resign-master', ResignMasterController::class);
    // Route::resource('employee-resign-details', EmployeeResignDetailsController::class);

    $router->get('/approval-form', 'ApprovalFormController@showApprovalForm');
    $router->get('/approved-form', 'ApprovalFormController@showApprovalForm');
    $router->get('/reject-form', 'ApprovalFormController@showApprovalForm');
    Route::post('/update-approval-status', 'ApprovalFormController@approvalForm');
    Route::post('/update-reject-status', 'ApprovalFormController@rejectForm');

});
