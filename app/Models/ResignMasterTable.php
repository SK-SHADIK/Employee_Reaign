<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignMasterTable extends Model
{
    protected $table = "resign_master_table";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'employee_resign_id',
        'resign_master_table_id',
        // 'cb',
        // 'ub',
    ];
}
