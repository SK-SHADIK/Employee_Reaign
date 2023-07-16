<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignView extends Model
{
    protected $table = "resign_view";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';

    protected $fillable = [
        'approval_status_id',
        'resign_view_id',
        // 'cb',
        // 'ub',
    ];
}
