<?php

namespace App\Admin\Controllers;

use App\Models\ResignView;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ResignViewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ResignView';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ResignView());

        $grid->column('id', __('Id'));
        $grid->column('approval_status_id', __('Approval status id'));
        $grid->column('resign_master_table_id', __('Resign master table id'));
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
        $show = new Show(ResignView::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('approval_status_id', __('Approval status id'));
        $show->field('cb', __('Cb'));
        $show->field('cd', __('Cd'));
        $show->field('ub', __('Ub'));
        $show->field('ud', __('Ud'));
        $show->field('resign_master_table_id', __('Resign master table id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ResignView());

        $form->number('approval_status_id', __('Approval status id'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);
        $form->number('resign_master_table_id', __('Resign master table id'));

        return $form;
    }
}
