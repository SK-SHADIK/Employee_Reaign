<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResignDetails;
use App\Models\ResignMaster;
use App\Models\Employee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;

class ApprovalFormController extends AdminController
{
    protected function showApprovalForm()
    {
        $resignMasterId = Request::query('id');
        $resignMasters = EmployeeResignDetails::where('resign_master_id', $resignMasterId)->with('employeeAccessTool')->get();

        $resignMaster = ResignMaster::find($resignMasterId);

        if ($resignMasters->isEmpty()) {
            return Redirect::back()->with('error', 'Invalid ID');
        }

        $employee = Employee::find($resignMaster->employee_id);
        $employeeName = $employee ? $employee->emp_name : '';

        $employeeId = $employee ? $employee->emp_id : '';

        $employeeOffice = $employee ? $employee->phone_office : '';
        $employeePersonal = $employee ? $employee->phone_personal : '';
        
        return view('approvalFrom', compact('resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal'));


    }
}
