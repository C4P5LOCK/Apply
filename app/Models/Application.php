<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Application extends Model
{
    //
    use SoftDeletes;
    
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
        'progress',
        'admin_comment',
        'submitted_at',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
