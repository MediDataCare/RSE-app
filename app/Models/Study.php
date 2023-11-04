<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Study extends Model
{
    use HasFactory, SoftDeletes, HasTimestamps;

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
