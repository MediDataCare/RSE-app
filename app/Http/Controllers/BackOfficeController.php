<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Study;
use App\Models\User;

class BackOfficeController extends Controller
{

    public function createExamType(){
        return view('backend.exam_type.exam_type', ['examType' => [], 'action' => 'create']);
    }

    public function indexExamType(){
        return view('backend.exam_type.table');
    }

    public function removeExamType($id){
    $examType = ExamType::find($id);
    $examType->delete();
    return redirect()->action([self::class, 'indexExamType']);
}

    public function showExamType($id){
        $examType = ExamType::find($id);
        return view('backend.exam_type.exam_type', ['examType' => $examType, 'action' => 'show']);
    }

    public function editExamType($id){
        $examType = ExamType::find($id);
        return view('backend.exam_type.exam_type', ['examType' => $examType, 'action' => 'edit']);
    }

    public function home(){
        return view('backend.home');
    }

    public function entities(){
        return view('backend.entities.estities');
    }

    public function aproveEntitie($id){
        $entitie = User::find($id);
        $entitie->state = 'approved';
        $entitie->save();
        return redirect()->action([BackOfficeController::class, 'entities']);
    }

    public function rejectEntitie($id){
        $entitie = User::find($id);
        $entitie->state = 'rejected';
        $entitie->save();
        return redirect()->action([BackOfficeController::class, 'entities']);
    }

    public function showAllStudies($entitiesId){
        $entitie = User::find($entitiesId);
        return view('backend.entities.all-studies', ['entitiesId' => $entitie->id, 'title'=> $entitie->name]);
    }

    public function showStudy($entitieId, $studyId){
        $study = Study::find($studyId);
        $allExams = Exam::whereIn('id', data_get($study, 'data.pending'))->get();
        return view('backend.entities.study', ['study' => $study, 'allExams' => $allExams, 'action' => 'show', 'entitieId' => $entitieId]);
    }


    public function aproveStudy($entitiesId, $id){
        $study = Study::find($id);
        $study->state = 'approved';
        $study->save();
        return redirect()->action([BackOfficeController::class, 'showAllStudies'], ['entitiesId' => $entitiesId]);

    }

    public function rejectStudy($entitiesId, $id){
        $study = Study::find($id);
        $study->state = 'rejected';
        $study->save();
        return redirect()->action([BackOfficeController::class, 'showAllStudies'], ['entitiesId' => $entitiesId]);
    }

}
