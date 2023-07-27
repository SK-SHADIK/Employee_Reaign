<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "hr.HR_EMP_DETAILS";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
