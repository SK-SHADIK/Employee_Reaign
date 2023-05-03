<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeAccessTool;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmployeeAccessToolController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeAccessTool';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeAccessTool());

        $grid->column('id', __('Id'));
        $grid->column('tool', __('Tool'));
        $grid->column('status', __('Status'));
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
        $show = new Show(EmployeeAccessTool::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('tool', __('Tool'));
        $show->field('status', __('Status'));
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
        $form = new Form(new EmployeeAccessTool());

        $form->text('tool', __('Tool'));
        $form->switch('status', __('Status'))->default(1);
        $form->text('cb', __('Cb'));
        $form->text('ub', __('Ub'));

        return $form;
    }
}
