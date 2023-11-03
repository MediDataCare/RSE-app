<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FrontEndController;
use App\Models\Exam;
use App\Models\ExamType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class UserForm extends Component
{

    public $allexamsType = [];
    public $examsType = [];
    public $examsTypeOptions = [];
    public $showForm = false;
    public $selectExamType = [];
    public $inputs = [];

    public function mount()
    {
        $this->allexamsType = ExamType::all();
        $exmasGroup = $this->allexamsType->pluck('group', 'id')->unique();
        foreach ($exmasGroup as $group){
            $this->examsTypeOptions[$group] = $this->allexamsType->where('group', $group)->pluck('title', 'id')->toArray();
        }

    }

    public function render()
    {
        return view('frontend.users.Livewire.form');
    }

    public function updatingSelectExamType($value)
    {
        $this->examsType = $this->allexamsType->whereIn('id', $value);
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
//            $request = new Request($data);
//
//            $validated = $request->validate([
//                'title' => 'required|unique:posts|max:255',
//                'body' => 'required',
//            ]);
            Exam::create($data);
            return redirect()->action([FrontEndController::class, 'userProfile']);
        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }

}
