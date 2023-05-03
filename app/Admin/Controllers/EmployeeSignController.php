<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeSign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeeSignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeSign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeSign());

        $grid->column('id', __('Id'));
        $grid->column('employee_id', __('Employee id'));
        $grid->column('employee_sign', __('Employee sign'));
        $grid->column('cb', __('Cb'));
        $grid->column('cd', __('Cd'));
        $grid->column('ub', __('Ub'));
        $grid->column('ud', __('Ud'));

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
        $show = new Show(EmployeeSign::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_id', __('Employee id'));
        $show->field('employee_sign', __('Employee sign'));
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
        $form = new Form(new EmployeeSign());

        $form->number('employee_id', __('Employee id'));
        $form->textarea('employee_sign', __('Employee sign'));
        $form->text('cb', __('Cb'));
        $form->text('ub', __('Ub'));

        return $form;
    }
}
