<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeSign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Database\Eloquent\Builder;

class EmployeeSignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Employee Sign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeSign());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('employee_id', __('Employee Id'))->sortable();
        $grid->column('employee_sign', __('Employee sign'))->display(function ($value) {
            
            $decodeImage = "<img src='" . $value . "' alt='Employee Sign' style='height: 60px; width:120px;' />";
            return $decodeImage;
        });
        $grid->column('cd', __('Cd'))->sortable();

        $grid->model()->orderBy('id', 'desc');

        $grid->filter(function ($filter) {
            $filter->like('employee_id', __('Employee Id'));
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


       $form->text('employee_id', 'Employee Id');
       $form->image('employee_sign', 'Image');
       
       $form->hidden('cb', __('Cb'))->value(auth()->user()->username);
       $form->hidden('ub', __('Ub'))->value(auth()->user()->username);

       $form->saved(function (Form $form) {
            $id=$form->model()->id;
            $employeeSign=EmployeeSign::find($id);
            
            $imagePath = public_path('upload/' . $employeeSign->employee_sign);
            $imageData = 'data:image/png;base64,' . base64_encode(file_get_contents($imagePath));
            $employeeSign->employee_sign = $imageData;
            $employeeSign->save();
            unlink($imagePath);
        });
       
       return $form;
    }
    
}
