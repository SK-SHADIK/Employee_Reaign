<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeReaignTool;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeeReaignToolController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeReaignTool';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeReaignTool());

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
        $show = new Show(EmployeeReaignTool::findOrFail($id));

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
        $form = new Form(new EmployeeReaignTool());

        $form->number('employee_id', __('Employee id'));
        $form->number('employee_access_tool_id', __('Employee access tool id'));
        $form->switch('had_access', __('Had access'));
        $form->switch('access_removed', __('Access removed'));
        $form->text('remarks', __('Remarks'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
