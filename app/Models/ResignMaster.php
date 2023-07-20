<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignMaster extends Model
{
    protected $table = "resign_master";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'employee_id', 
        'approval_status_id', 
        'checked_by', 
        'author_by'
    ];

    public function emp()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function approvalStatus()
    {
        return $this->hasOne(ApprovalStatus::class, 'id', 'approval_status_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function as()
    {
        return $this->belongsTo(ApprovalStatus::class, 'approval_status_id');
    }
    
}
