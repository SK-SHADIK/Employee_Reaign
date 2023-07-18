<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResignDetails extends Model
{
    protected $table = "employee_resign_details";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
