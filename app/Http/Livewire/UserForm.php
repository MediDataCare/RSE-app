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
    public $message;
    public $obs = [];

    public function mount()
    {
        $this->allexamsType = ExamType::all();
        $exmasGroup = $this->allexamsType->pluck('group', 'id')->unique();
        foreach ($exmasGroup as $group) {
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
        $this->message = null;
    }

    public function storeExam()
    {
        try {

            $this->message = null;
            $user = Auth::user();

            $parameters = [];
            $dataExams = [];
            foreach ($this->selectExamType as $value) {
                $data = [];
                $examType = ExamType::where('id', $value)->first();
                if (data_get($examType, 'parameters.type') === 'number') {
                    if (!empty(data_get($examType, 'parameters.min-number'))) {
                        if (data_get($this->inputs, $value) < data_get($examType, 'parameters.min-number', 0)) {
                            $this->message[$examType->id] = "Insira um número maior que " . data_get($examType, 'parameters.min-number');
                            break;
                        }
                    }
                    if (!empty(data_get($examType, 'parameters.max-number'))) {
                        if (data_get($this->inputs, $value) > data_get($examType, 'parameters.max-number', 0)) {
                            $this->message[$examType->id] = "Insira um número menor que " . data_get($examType, 'parameters.max-number');
                            break;
                        }
                    }
                }
                $type = strtolower(data_get($examType, 'title'));
                $data['exams_types_id'] = $value;
                $data['user_id'] = empty($user) ? 0 : $user->id;
                $data['parameters'] = [$type => $this->inputs[$value], 'name' => data_get($examType, 'title', '-'), 'observations' => data_get($this->obs, $value . '.observations', '-')];
                array_push($dataExams, $data);
            }
            if (empty($this->message)) {
                foreach ($dataExams as $data) {
                    Exam::create($data);
                }
                return redirect()->action([FrontEndController::class, 'userProfile']);
            }

        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }

}
