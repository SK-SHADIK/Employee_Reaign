<?php

namespace App\Admin\Controllers;

use App\Models\ResignMasterTable;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResignMasterTableController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ResignMasterTable';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ResignMasterTable());

        $grid->column('id', __('Id'));
        $grid->column('employee_resign_id', __('Employee resign id'));
        $grid->column('resign_view_id', __('Resign view id'));
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
        $show = new Show(ResignMasterTable::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('employee_resign_id', __('Employee resign id'));
        $show->field('resign_view_id', __('Resign view id'));
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
        $form = new Form(new ResignMasterTable());

        $form->number('employee_resign_id', __('Employee resign id'));
        $form->number('resign_view_id', __('Resign view id'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
