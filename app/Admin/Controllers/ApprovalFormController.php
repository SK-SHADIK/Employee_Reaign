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
    /*
     * Show the approval form based on the approval status.
     */
    protected function showApprovalForm()
    {
        try {
            $resignMasterId = request('id');
            $resignMasters = EmployeeResignDetails::where('resign_master_id', $resignMasterId)->with('employeeAccessTool')->get();

            $resignMaster = ResignMaster::find($resignMasterId);
            $authorBy = $resignMaster ? $resignMaster->author_by : '';
            $checkedBy = $resignMaster ? $resignMaster->checked_by : '';
            $rejectedReason = $resignMaster ? $resignMaster->rejected_reason : '';

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
            } elseif ($resignMaster->approval_status_id == 2) {

                $employeeSign = EmployeeSign::where('employee_id', $checkedBy)->first();
                $checkedBySign = $employeeSign ? $employeeSign->employee_sign : '';

                $employeeSign = EmployeeSign::where('employee_id', $authorBy)->first();
                $authorBySign = $employeeSign ? $employeeSign->employee_sign : '';

                return view('approved-form', compact('resignMasterId', 'resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal', 'employeeDesignation', 'checkedBySign', 'authorBySign'));
            } elseif ($resignMaster->approval_status_id == 3) {
                return view('reject-form', compact('resignMasterId', 'resignMasters', 'resignMaster', 'employeeName', 'employeeId', 'employeeOffice', 'employeePersonal', 'employeeDesignation', 'authorBy', 'rejectedReason'));
            }
        } catch (\Exception $e) {
            Log::error('Error in showApprovalForm: ' . $e->getMessage());
            return Redirect::back()->with('error', 'An error occurred while processing the request.');
        }
    }

    /*
     * Update the approval status to 'approved'.
     */
    public function approvalForm(Request $request)
    {
        try {
            $resignMasterID = $request->input('id');
            $loggedInUser = Auth::user();

            if ($loggedInUser) {
                $newApprovalStatusID = 2;
                $authorBy = $loggedInUser->username;

                ResignMaster::where('id', $resignMasterID)
                    ->update(['approval_status_id' => $newApprovalStatusID, 'author_by' => $authorBy]);

                return redirect('/admin/approved-form')->with('success', 'Approval status updated successfully');
            } else {
                return redirect()->back()->with('error', 'User not logged in');
            }
        } catch (\Exception $e) {
            Log::error('Error in approvalForm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }

    /*
     * Update the approval status to 'rejected'.
     */
    public function rejectForm(Request $request)
    {
        try {
            $request->validate([
                'rejected_reason' => 'required|string',
            ]);
            $resignMasterID = $request->input('id');
            $rejectedReason = $request->input('rejected_reason');
            $loggedInUser = Auth::user();

            if ($loggedInUser) {
                $newApprovalStatusID = 3;
                $authorBy = $loggedInUser->name . ' (' . $loggedInUser->username . ')';

                ResignMaster::where('id', $resignMasterID)
                    ->update([
                        'approval_status_id' => $newApprovalStatusID,
                        'author_by' => $authorBy,
                        'rejected_reason' => $rejectedReason,
                    ]);

                return redirect()->back()->with('success', 'Approval status updated successfully');
            } else {
                return redirect()->back()->with('error', 'User not logged in');
            }
        } catch (\Exception $e) {
            Log::error('Error in rejectForm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }
}
