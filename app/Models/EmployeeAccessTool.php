<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAccessTool extends Model
{
    protected $table = "employee_access_tool";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
    protected $fillable = ['employee_id', 'tool', 'had_access', 'access_removed', 'remarks'];

}
