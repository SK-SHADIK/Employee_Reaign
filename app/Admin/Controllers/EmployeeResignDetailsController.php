<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResignDetails;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Builder;


class EmployeeResignDetailsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employee Resign Details';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeResignDetails());

        $grid->column('id', __('Id'))->sortable();
        // $grid->column('resign_master_id', __('Resign master id'));
        $grid->emp()->emp_id('Employee ID')->sortable();
        $grid->emp()->emp_name('Employee Name');
        $grid->accesstool()->tool('Access Tools');
        $grid->column('had_access', __('Had access'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});

        $grid->column('access_removed', __('Access removed'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});
        $grid->column('remarks', __('Remarks'))->editable();
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->quickSearch(function ($model, $query) {
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_id', 'like', "%{$query}%");
            });
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_name', 'like', "%{$query}%");
            });
        })->placeholder('Search Here Employee id Or Name...');

        $grid->disableFilter();

        $grid->disableCreateButton();
        $grid->disableActions();

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
        $show = new Show(EmployeeResignDetails::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('resign_master_id', __('Resign master id'));
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
        $form = new Form(new EmployeeResignDetails());

        $form->number('resign_master_id', __('Resign master id'));
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
