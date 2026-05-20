<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'gender',
        'dob',
        'address',
        'school',
        'qualification',
        'cgpa',
        'passport',
        'status',
        'submitted_at',
    ];
}
