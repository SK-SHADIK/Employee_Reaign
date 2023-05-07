<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSign extends Model
{
    protected $table = "employee_sign";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    public function emptable()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id'); 
    }
}
