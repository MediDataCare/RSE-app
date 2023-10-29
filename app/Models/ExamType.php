<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $table = 'exams_types';

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'parameters' => 'object',
        'data' => 'object',
    ];

    protected $fillable = [
        'title',
        'description',
        'parameters',
    ];

}
