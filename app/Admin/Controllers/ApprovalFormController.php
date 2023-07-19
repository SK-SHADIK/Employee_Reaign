<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResignDetails;
use App\Models\ResignMaster;
use App\Models\EmployeeSign;
use App\Models\Employee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ApprovalFormController extends AdminController
{
    protected function showApprovalForm()
    {

        $resignMasterId = request('id');
        $resignMasters = EmployeeResignDetails::where('resign_master_id', $resignMasterId)->with('employeeAccessTool')->get();

        $resignMaster = ResignMaster::find($resignMasterId);
        $authorBy = $resignMaster ? $resignMaster->author_by : '';
        $checkedBy = $resignMaster ? $resignMaster->checked_by : '';

        

        if ($resignMasters->isEmpty()) {
            return Redirect::back()->with('error', 'Invalid ID');
        }

        $employee = Employee::find($resignMaster->employee_id);

        $employeeName = $employee ? $employee->emp_name : '';
        $employeeId = $employee ? $employee->emp_id : '';
        $employeeOffice = $employee ? $employee->phone_office : '';
        $employeePersonal = $employee ? $employee->phone_personal : '';
        $employeeDesignation = $employee ? $employee->designation : '';
        
        if ($resignMaster->approval_status_id == 1) {
            return view('approvalFrom', compact('resignMasterId', 'resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal', 'employeeDesignation'));
        } elseif ($resignMaster->approval_status_id == 2){

            $employeeSign = EmployeeSign::where('employee_id', $checkedBy)->first();
            $checkedBySign = $employeeSign ? $employeeSign->employee_sign : '';
            
            $employeeSign = EmployeeSign::where('employee_id', $authorBy)->first();
            $authorBySign = $employeeSign ? $employeeSign->employee_sign : '';

            return view('approved-form', compact('resignMasterId', 'resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal', 'employeeDesignation', 'checkedBySign', 'authorBySign'));
        } elseif ($resignMaster->approval_status_id == 3){
            return view('reject-form', compact('resignMasterId', 'resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal', 'employeeDesignation', 'authorBy'));
        }
    }

    public function approvalForm(Request $request)
    {
        $resignMasterID = $request->input('id');
        $loggedInUser = Auth::user();

        if ($loggedInUser) {
            $newApprovalStatusID = 2;
            $authorBy = $loggedInUser->username;
    
            ResignMaster::where('id', $resignMasterID)
                ->update(['approval_status_id' => $newApprovalStatusID, 'author_by' => $authorBy]);
    
            return redirect('/admin/approved-form')->with('success', 'Approval status updated successfully');
        } else {
            // Handle the case when no user is logged in
            return redirect()->back()->with('error', 'User not logged in');
        }
    }
    public function rejectForm(Request $request)
    {
        $resignMasterID = $request->input('id');
        $loggedInUser = Auth::user();

        if ($loggedInUser) {
            $newApprovalStatusID = 3;
            $authorBy = $loggedInUser->username;
    
            ResignMaster::where('id', $resignMasterID)
                ->update(['approval_status_id' => $newApprovalStatusID, 'author_by' => $authorBy]);
    
            return redirect()->back()->with('success', 'Approval status updated successfully');
        } else {
            // Handle the case when no user is logged in
            return redirect()->back()->with('error', 'User not logged in');
        }
    }
}
