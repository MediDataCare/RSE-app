<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $casts = [
        'parameters' => 'object',
    ];

    protected $fillable = [
        'parameters',
        'exams_types_id',
        'user_id',
        'group'
    ];

    public function examType(){
        return $this->belongsTo(ExamType::class, 'exams_types_id', 'id');
    }

    public function examOwner(){
        return $this->belongsTo(User::class, 'user_id', 'id')->first();
    }
}
