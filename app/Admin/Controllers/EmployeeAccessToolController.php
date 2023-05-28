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
    protected $title = 'Employee Access Tool';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeAccessTool());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('tool', __('Tool'));
        $grid->column('status', __('Status'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Active</span>' :
            '<span style="color: red; font-weight:900; ">Not Active</span>';});
        $grid->column('cd', __('Cd'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('tool', __('Tool'));
        });

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
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
