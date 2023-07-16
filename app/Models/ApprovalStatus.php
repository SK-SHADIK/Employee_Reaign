<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStatus extends Model
{
    protected $table = "approval_status";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
