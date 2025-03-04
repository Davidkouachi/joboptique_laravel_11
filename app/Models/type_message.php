<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class type_message extends Model
{
    protected $fillable = [
        'type',
        'message',
    ];
}
