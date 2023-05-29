<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use Illuminate\Http\Request;

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
        $grid->emptable()->emp_id('Employee_ID');
        $grid->emptable()->emp_name('Employee_Name');
        $grid->tool()->tool('Access Tool');
        $grid->column('had_access', __('Had access'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});

        $grid->column('access_removed', __('Access removed'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});
        $grid->column('remarks', __('Remarks'));
        $grid->column('cd', __('Cd'));

        $grid->model()->orderBy('id', 'desc');

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

        $Emp = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        $form->select('employee_id', __('Employee ID & Name'))->options($Emp);


        $tools = \App\Models\EmployeeAccessTool::all();
        
        foreach ($tools as $tool) {
            $form->text('employee_access_tool_id')->value($tool->id)->readonly();
            $form->switch('had_access', __('Had access'));
            $form->switch('access_removed', __('Access removed'));
            $form->text('remarks', __('Remarks'));

            
            $form->saving(function (Form $form) use ($tool) {
                $employeeId = $form->input('employee_id');
                $toolId = $tool->id;
                $hadAccess = $form->input('had_access');
                $accessRemoved = $form->input('access_removed');
                $remarks = $form->input('remarks');
                
                $resignObj = new \App\Models\EmployeeResign();
                $employeeAccessTool = [
                    'employee_id' => $employeeId,
                    'employee_access_tool_id' => $toolId,
                    'had_access' => $hadAccess,
                    'access_removed' => $accessRemoved,
                    'remarks' => $remarks,
                ];
                
                $resignObj->create($employeeAccessTool);
            });
        }

        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
    
}