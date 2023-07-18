<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResignDetails extends Model
{
    protected $table = "employee_resign_details";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'resign_master_id',
        'employee_id', 
        'employee_access_tool_id', 
        'had_access', 
        'access_removed', 
        'remarks'
    ];

    public function emp()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function accesstool()
    {
        return $this->hasOne(EmployeeAccessTool::class, 'id', 'employee_access_tool_id');
    }
}
