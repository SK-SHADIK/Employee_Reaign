<?php

namespace App\Admin\Controllers;

use App\Models\ResignMaster;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->column('employee_id', __('Employee id'));
        $grid->column('approval_status_id', __('Approval status id'));
        $grid->column('checked_by', __('Checked by'));
        $grid->column('author_by', __('Author by'));
        $grid->column('cd', __('Cd'))->sortable();

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

        $form->number('employee_id', __('Employee id'));
        $form->number('approval_status_id', __('Approval status id'));
        $form->text('checked_by', __('Checked by'));
        $form->text('author_by', __('Author by'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
