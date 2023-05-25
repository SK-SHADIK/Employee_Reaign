<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeeResignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeResign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeResign());

        $grid->column('id', __('Id'));
        $grid->column('employee_id', __('Employee id'));
        $grid->column('employee_access_tool_id', __('Employee access tool id'));
        $grid->column('had_access', __('Had access'));
        $grid->column('access_removed', __('Access removed'));
        $grid->column('remarks', __('Remarks'));
        $grid->column('cd', __('Cd'));

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
        $show = new Show(EmployeeResign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('employee_access_tool_id', __('Employee access tool id'));
        $show->field('had_access', __('Had access'));
        $show->field('access_removed', __('Access removed'));
        $show->field('remarks', __('Remarks'));
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
        $form = new Form(new EmployeeResign());

        $Employee = \App\Models\Employee::pluck('emp_id', 'id')->toArray();
        $form->select('employee_id', __('Employee_ID'))->options($Employee);
        $tools = \App\Models\EmployeeAccessTool::all();

        foreach ($tools as $tool) {
            $form->text("Tool Name")->value($tool->tool)->readonly();
            $form->switch('had_access', __('Had access'));
            $form->switch('access_removed', __('Access removed'));
            $form->text('remarks', __('Remarks'));
        }

        $form->saving(function (Form $form) {
            $employeeId = $form->input('employee_id');
            $toolName = $form->input('Tool Name');
            $hadAccess = $form->input('had_access');
            $accessRemoved = $form->input('access_removed');
            $remarks = $form->input('remarks');
            
            $resignObj = new \App\Models\EmployeeReaignTool();
            $employeeAccessTool = [
                'employee_id' => $employeeId,
                'employee_access_tool_id' => 1,
                'had_access' => $hadAccess,
                'access_removed' => $accessRemoved,
                'remarks' => $remarks,
            ];
            
            $resignObj->create($employeeAccessTool);
        });
        
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
    public function create(Content $content)
    {
        return $content
            ->title('Create')
            ->view('resign');
    }
}
