<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;

class ApprovalFormController extends AdminController
{
    protected function showApprovalForm(){
        return view('approvalFrom');
    }
    
}
