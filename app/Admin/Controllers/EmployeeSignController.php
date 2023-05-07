<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeSign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Intervention\Image\ImageManagerStatic as Image;


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
        $grid->emptable()->emp_id('Employee_ID');
        $grid->emptable()->emp_name('Employee_Name');
        $grid->column('employee_sign', __('Employee sign'));
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

        
       $Employee = \App\Models\Employee::pluck('emp_id', 'id')->toArray();
       $form->select('employee_id', __('Employee_ID'))->options($Employee)->rules('required');
       $form->image('image_field', 'Image')->base64();
    //    $imagePath = public_path('storage');
    //    $base64 = base64_encode(file_get_contents($imagePath));

    //    $image = Image::make(base64_decode($image_field));
    //    $image->resize(300, 200);
    //    $image->save('path/to/new-image.jpg');
       
    //    $form->hidden('employee_sign', __('employee_sign'))->value($image_field);
       
       $form->hidden('cb', __('Cb'))->value(auth()->user()->name);
       $form->hidden('ub', __('Ub'))->value(auth()->user()->name);
       
       return $form;
    }
}
