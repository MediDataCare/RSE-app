<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FrontEndController;
use App\Models\Exam;
use App\Models\ExamType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserForm extends Component
{

    public $examsType = [];
    public $examsTypeOptions = [];
    public $showForm = false;
    public $selectExamType;
    public $inputs = [];

    public function mount()
    {
        $this->examsType = ExamType::all();
        $this->examsTypeOptions = $this->examsType->pluck('title', 'id');
    }

    public function render()
    {
        return view('frontend.users.Livewire.form');
    }

    public function updatingSelectExamType($value)
    {
        $this->examsType = $this->examsType->find($value);
        $this->showForm = true;
    }

    public function storeExam()
    {
        try {
            $user = Auth::user();

            $data = [];
            $data['exams_types_id'] = $this->selectExamType;
            $data['user_id'] = empty($user) ? 0 : $user->id;
            $data['parameters'] = [];
            foreach ($this->inputs as $input) {
                array_push($data['parameters'], $input);
            }
            Exam::create($data);
            return redirect()->action([FrontEndController::class, 'userProfile']);
        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }

}
