<?php

namespace App\Admin\Controllers;

use App\Models\ResignMaster;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Redirect;

class ApprovalFormController extends AdminController
{
    protected function showApprovalForm(){
        return view('approvalFrom');
    }
   
}
