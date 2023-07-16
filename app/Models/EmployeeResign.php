<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResign extends Model
{
    protected $table = "employee_resign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
    protected $fillable = ['employee_id', 'employee_access_tool_id', 'had_access', 'access_removed', 'remarks', 'approval_status_id', 'resign_master_table_id',];

    public function emptable()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function tool()
    {
        return $this->hasOne(EmployeeAccessTool::class, 'id', 'employee_access_tool_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
}
