<?php

namespace App\Admin\Controllers;

use App\Models\EmployeeResign;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;


class EmployeeResignController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'EmployeeResign';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmployeeResign());

        $grid->column('id', __('Id'))->sortable();
        $grid->emptable()->emp_id('Employee ID')->sortable();
        $grid->emptable()->emp_name('Employee Name');
        $grid->tool()->tool('Access Tool');
        $grid->column('had_access', __('Had access'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});

        $grid->column('access_removed', __('Access removed'))->display(function ($value) {
            return $value ? '<span style="color: green; font-weight:900; ">Yes</span>' :
            '<span style="color: red; font-weight:900; ">No</span>';});
        $grid->column('remarks', __('Remarks'))->editable();
        $grid->column('cd', __('Cd'))->sortable();

        $grid->quickSearch(function ($model, $query) {
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_id', 'like', "%{$query}%");
            });
            $model->orWhereHas('employee', function (Builder $queryr) use ($query) {
                $queryr->where('emp_name', 'like', "%{$query}%");
            });
        })->placeholder('Search Here Employee id Or Name...');

        $grid->disableFilter();

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
        $show = new Show(EmployeeResign::findOrFail($id));

        $show->field('id', __('Id'));
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
        $form = new Form(new EmployeeResign());

        $Employee = \App\Models\Employee::all()->map(function ($emp) {
            return [
                'id' => $emp->id,
                'label' => "{$emp->emp_id} - {$emp->emp_name}",
            ];
        })->pluck('label', 'id')->toArray();
        
        $form->select('employee_id', __('Employee ID & Name'))->options($Employee);
        
        $tools = \App\Models\EmployeeAccessTool::all();
        
        foreach ($tools as $key=> $tool) {
            // $form->text('employee_access_tool_id')->value($tool->id)->readonly();
            $form->text('employee_access_tool')->value($tool->tool)->readonly();
            $form->hidden('employee_access_tool_id')->value($tool->id);

            $form->switch('had_access'. $key, __('Had access'));
            $form->switch('access_removed'. $key, __('Access removed'));
            $form->text('remarks'. $key, __('Remarks'));
            $form->hidden('cb'.$key, __('Cb'))->value(auth()->user()->username);
            $form->hidden('ub'.$key, __('Ub'))->value(auth()->user()->username);
            // $form->hidden('approval_status_id', __('approval_status_id'))->default(1);
        
            $form->saving(function (Form $form) use ($tool, $key) {
                $employeeId = $form->input('employee_id');
                $toolId = $tool->id;
                $hadAccess = $form->input('had_access'.$key);
                $accessRemoved = $form->input('access_removed'.$key);
                $remarks = $form->input('remarks'.$key);
                $cb = $form->input('cb'.$key);
                $ub = $form->input('ub'.$key);
        
                $resignObj = new \App\Models\EmployeeResign();
                $employeeAccessTool = [
                    'employee_id' => $employeeId,
                    'employee_access_tool_id' => $toolId,
                    'had_access' => $hadAccess,
                    'access_removed' => $accessRemoved,
                    'remarks' => $remarks,
                    'cb' => $cb,
                    'ub' => $ub,
                ];

                $resignMaster = new \App\Models\ResignMasterTable();
                $employeeResignMaster = [
                    'employee_resign_id' => 1,
                    'resign_master_table_id' => 1,
                    'cb' => $cb,
                    'ub' => $ub,
                ];
                $resignMaster->create($employeeResignMaster);
                
                $resignview = new \App\Models\ResignView();
                $employeeResignView = [
                    'approval_status_id' => 1,
                    'resign_view_id' => 1,
                    'cb' => $cb,
                    'ub' => $ub,
                ];
                $resignview->create($employeeResignView);

                $resignObj->create($employeeAccessTool);
            });
        }

        $form->saving(function (Form $form){
            return Redirect::to('/admin/employee-resign');

        });        

        return $form;
    }
    
    // public function create(Content $content) {
    //     return $content
    //         ->title('Create')
    //         ->view('resignForm');
    // }
}