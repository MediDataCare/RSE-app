<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $table = 'studies';

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'state' => 'string',
        'data' => 'object',
    ];

    protected $fillable = [
        'title',
        'description',
        'state',
        'data',
        'user_id',
    ];
}
