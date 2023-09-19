<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaving_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'request_time',
        'reason',
        'status',
    ];
}
