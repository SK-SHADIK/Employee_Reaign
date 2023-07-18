<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResignMaster extends Model
{
    protected $table = "resign_master";
    const CREATED_AT = 'cd';
    const UPDATED_AT = 'ud';
}
