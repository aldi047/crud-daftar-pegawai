<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'group',
        'echelon',
        'position',
        'office_location',
        'department'
    ];
}
