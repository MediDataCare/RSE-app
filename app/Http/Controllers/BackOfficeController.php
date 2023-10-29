<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamType;

class BackOfficeController extends Controller
{

    public function createExamType(){
        return view('backend.exam_type.exam_type');
    }

    public function indexExameType(){
        return view('backend.exam_type.table');
    }

    public function showExameType($id){
        $examType = ExamType::find($id);
        return view('backend.exam_type.exam_type', ['examType' => $examType, 'action' => 'show']);
    }

}
