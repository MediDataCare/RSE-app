<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FrontEndController;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Study;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Exception;


class EntitiesForm extends Component
{

    public $inputs = [];
    public $filters = [];
    public $examsTypeOptions = [];
    public $examsType = [];
    public $allExams = [];
    public $allExamsOriginal = [];
    public $users = [];
    public $action = '';
    public $gender = ['male' => 'Masculino', 'female' => 'Feminino', 'other' => 'Outro'];
    public $study;

    public function mount()
    {

        if(!empty($this->study)){
            //Filters
            data_set($this->filters, 'exams', data_get($this->study, 'data.filters.exams'));
            data_set($this->filters, 'age_min', data_get($this->study, 'data.filters.age_min'));
            data_set($this->filters, 'age_max', data_get($this->study, 'data.filters.age_max'));
            data_set($this->filters, 'sex', data_get($this->study, 'data.filters.sex'));

            //Inputs
            data_set($this->inputs, 'title', data_get($this->study, 'title'));
            data_set($this->inputs, 'description', data_get($this->study, 'description'));
            data_set($this->inputs, 'expected_Exams', data_get($this->study, 'data.expected_Exams'));
            data_set($this->inputs, 'duration', data_get($this->study, 'data.duration'));
        }
        $this->resetList();
    }

    public function render()
    {
        return view('frontend.entities.Livewire.form');
    }

    public function resetList()
    {
        $this->examsType = ExamType::all();
        $this->allExams = Exam::all();
        $this->allExamsOriginal = $this->allExams;
        $exmasGroup = $this->examsType->pluck('group', 'id')->unique();
        foreach ($exmasGroup as $group) {
            $this->examsTypeOptions[$group] = $this->examsType->where('group', $group)->pluck('title', 'id')->toArray();
        }
        $this->users = User::all();
        $this->setFilters();
    }

    public function updated($property, $value)
    {
        $this->resetList();
        $explode = explode('.', $property);
        if ($explode[0] === 'filters') {
            if(!empty(data_get($this->filters, 'exams'))){
                $this->examsType = $this->examsType->whereIn('id', data_get($this->filters, 'exams'));
                $this->allExams = $this->allExams->whereIn('exams_types_id', $this->examsType->pluck('id')->toArray());
            }
            if(!empty(data_get($this->filters, 'age_min'))){
                $users = $this->users->where('parameters.age', '>=', data_get($this->filters, 'age_min'));
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if(!empty(data_get($this->filters, 'age_max'))){
                $users = $this->users->where('parameters.age', '<=', data_get($this->filters, 'age_max'));
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if (!empty(data_get($this->filters, 'sex'))) {
                $users = $this->users->whereIn('parameters.sex', data_get($this->filters, 'sex'));
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
        }
    }

    public function setFilters()
    {
        if (!empty($examType = data_get($this->filters, 'exam_type_id'))) {
            $this->examsType = $this->examsType->find($examType);
            $this->allExams = $this->allExams->where('exams_types_id', $examType);
        }
        if (!empty($age = data_get($this->filters, 'age'))) {
            if ($age == 'young') {
                $users = $this->users->whereBetween('parameters.age', [0, 19]);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if ($age == 'adult') {
                $users = $this->users->whereBetween('parameters.age', [20, 59]);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if ($age == 'old') {
                $users = $this->users->where('parameters.age', '>=', 60);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
        }
        if (!empty($age = data_get($this->filters, 'sex'))) {
            if ($age == 'male') {
                $users = $this->users->where('parameters.sex', 'male');
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if ($age == 'female') {
                $users = $this->users->where('parameters.sex', 'female');
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if ($age == 'other') {
                $users = $this->users->where('parameters.sex', 'other');
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
        }
    }

    public function storeStudy()
    {
        try {
            $user = Auth::user();

            $data = [];
            $data['title'] = data_get($this->inputs, 'title');
            $data['description'] = data_get($this->inputs, 'description');
            $data['state'] = 'pending';
            $data['user_id'] = empty($user) ? 0 : $user->id;;
            $data['data'] = [];
            data_set($data, 'data.filters', $this->filters);
            data_set($data, 'data.duration', data_get($this->inputs, 'duration'));
            data_set($data, 'data.expected_Exams', data_get($this->inputs, 'expected_Exams'));
            data_set($data, 'data.pending', $this->allExams->pluck('id')->toArray());
            Study::create($data);
            return redirect()->action([FrontEndController::class, 'entitiesProfile']);
        } catch (\Exception $e) {
            dd($e);
            throw new Exception('Error');
        }
    }

    public function updateStudy()
    {
        try {
            $user = Auth::user();

            $data = [];
            $data['title'] = data_get($this->inputs, 'title');
            $data['description'] = data_get($this->inputs, 'description');
            $data['state'] = 'pending';
            $data['user_id'] = empty($user) ? 0 : $user->id;;
            $data['data'] = [];
            $data['data'] = data_get($this->study, 'data');
            data_set($data, 'data.filters', $this->filters);
            data_set($data, 'data.duration', data_get($this->inputs, 'duration'));
            data_set($data, 'data.expected_Exams', data_get($this->inputs, 'expected_Exams'));
            data_set($data, 'data.pending', $this->allExams->pluck('id')->toArray());
            $this->study->update($data);
            return redirect()->action([FrontEndController::class, 'entitiesProfile']);
        } catch (\Exception $e) {
            dd($e);
            throw new Exception('Error');
        }
    }
}
