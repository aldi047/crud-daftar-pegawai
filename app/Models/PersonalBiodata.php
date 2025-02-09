<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalBiodata extends Model
{
    protected $fillable = [
        'user_id',
        'npwp',
        'birth_place',
        'birth_date',
        'address',
        'gender',
        'phone_number',
        'religion'
    ];
}
