<?php

namespace App\Admin\Controllers;

use App\Models\ApprovalStatus;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApprovalStatusController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Approval Status';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ApprovalStatus());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('status', __('Approval Status'));
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->like('status', __('Approval Status'));
        });

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
        $show = new Show(ApprovalStatus::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('status', __('Approval Status'));
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
        $form = new Form(new ApprovalStatus());

        $form->text('status', __('Approval Status'));
        $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
        $form->hidden('ub', __('Ub'))->value(auth()->user()->name);

        return $form;
    }
}
