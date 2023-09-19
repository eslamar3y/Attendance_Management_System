<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'arrival_time',
        'q1',
        'q2',
        'leave_time',
    ];
}
