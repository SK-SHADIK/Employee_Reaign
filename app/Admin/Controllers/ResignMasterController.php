<?php

namespace App\Admin\Controllers;

use App\Models\ResignMaster;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;


class ResignMasterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Resign List';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ResignMaster());

        $grid->column('id', __('Id'))->sortable();
        $grid->emp()->emp_id('Employee ID')->sortable();
        $grid->emp()->emp_name('Employee Name');
        $grid->approvalStatus()->status('Approval Status');
        $grid->column('checked_by', __('Checked by'));
        $grid->column('author_by', __('Author by'));
        $grid->column('cd', __('Cd'))->sortable();
        $grid->column('actions', __('Show Details'))->display(function () {
            $id = $this->id;
            $url = '/admin/approval-form?id=' . $id;
            return '<a href="' . $url . '" class="btn" style="background-color: #8A2061; color: #fff;">Preview</a>';
        });
        
        $grid->model()->orderBy('id', 'desc');

        $grid->quickSearch(function ($model, $query) {
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_id', 'like', "%{$query}%");
            });
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_name', 'like', "%{$query}%");
            });
        })->placeholder('Search Here Employee id Or Name...');

        
        $grid->filter(function ($filter) {
            $filter->where(function ($query) {
                switch ($this->input) {
                    case '1':
                        $query->where('approval_status_id', '=', 1);
                        break;
                    case '2':
                        $query->where('approval_status_id', '=', 2);
                        break;
                    case '3':
                        $query->where('approval_status_id', '=', 3);
                        break;
                    case 'none':
                        $query->where('approval_status_id', '=', null);
                        break;
                }
            }, 'Approval Status', 'approval_status_filter')->radio([
                '' => 'All',
                '1' => 'Pending',
                '2' => 'Approved',
                '3' => 'Rejected',
                'none' => 'None',
            ]);
        
        });

        $grid->disableActions();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ResignMaster::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('approval_status_id', __('Approval status id'));
        $show->field('checked_by', __('Checked by'));
        $show->field('author_by', __('Author by'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));
        
        return $show;

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ResignMaster());

        $Employee = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        
        $form->select('employee_id', __('Employee ID & Name'))->options($Employee);

        $form->hidden('approval_status_id', __('Approval status id'))->default(1);
        $form->hidden('checked_by', __('Checked by'))->value(auth()->user()->username);
        $form->hidden('author_by', __('Author by'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        $tools = \App\Models\EmployeeAccessTool::where('status', true)->get();
        
        foreach ($tools as $key=> $tool) {
            // $form->text('employee_access_tool_id')->value($tool->id)->readonly();
            $form->text('employee_access_tool')->value($tool->tool)->readonly();
            $form->hidden('employee_access_tool_id')->value($tool->id);
            $form->switch('had_access'. $key, __('Had access'));
            $form->switch('access_removed'. $key, __('Access removed'));
            $form->text('remarks'. $key, __('Remarks'));
            $form->hidden('cb'.$key, __('Cb'))->value(auth()->user()->name);
            $form->hidden('ub'.$key, __('Ub'))->value(auth()->user()->name);
        }
        $form->saving(function (Form $form) {
            $resignMaster = new \App\Models\ResignMaster();
        
            // Save data in resign_master table
            $resignMaster->employee_id = $form->input('employee_id');
            $resignMaster->approval_status_id = $form->input('approval_status_id');
            $resignMaster->checked_by = $form->input('checked_by');
            $resignMaster->author_by = $form->input('author_by');
            $resignMaster->cb = $form->input('cb');
            $resignMaster->ub = $form->input('ub');
            $resignMaster->save();
        
            $tools = \App\Models\EmployeeAccessTool::where('status', true)->get();
        
            foreach ($tools as $key => $tool) {
                $employeeId = $form->input('employee_id');
                $toolId = $tool->id;
                $hadAccess = $form->input('had_access' . $key);
                $accessRemoved = $form->input('access_removed' . $key);
                $remarks = $form->input('remarks' . $key);
                $cb = $form->input('cb' . $key);
                $ub = $form->input('ub' . $key);
        
                $resignDetails = new \App\Models\EmployeeResignDetails();
                $resignDetails->resign_master_id = $resignMaster->id;
                $resignDetails->employee_id = $employeeId;
                $resignDetails->employee_access_tool_id = $toolId;
                $resignDetails->had_access = $hadAccess;
                $resignDetails->access_removed = $accessRemoved;
                $resignDetails->remarks = $remarks;
                $resignDetails->cb = $cb;
                $resignDetails->ub = $ub;
                $resignDetails->save();
            }
        
            return redirect('/admin/resign-master');
        });
        

        return $form;
    }
}
