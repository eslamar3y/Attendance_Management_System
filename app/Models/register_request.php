<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class register_request extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'role',
        'img',
        'status',
    ];
}
