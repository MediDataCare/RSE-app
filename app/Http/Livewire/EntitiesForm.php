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


class EntitiesForm  extends Component
{

    public $inputs = [];
    public $filters = [];
    public $examsTypeOptions = [];
    public $examsType = [];
    public $allExams = [];
    public $users = [];

    public function mount() {
            $this->resetList();
    }

    public function render() {
        return view('frontend.entities.Livewire.form');
    }

    public function resetList(){
        $this->examsType = ExamType::all();
        $this->examsTypeOptions = $this->examsType->pluck('title', 'id');
        $this->allExams = Exam::all();
        $this->users = User::all();
        $this->setFilters();
    }

    public function updated($property, $value){
        $this->resetList();
        $explode = explode('.', $property);
        if ($explode[0] === 'filters'){
            if($explode[1] === 'exam_type_id')
                $this->examsType = $this->examsType->find($value);
            if($explode[1] === 'age'){
                if($value == 'young'){
                    $users = $this->users->whereBetween('parameters.age', [0, 19]);
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if($value == 'adult'){
                    $users = $this->users->whereBetween('parameters.age', [20, 59]);
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if($value == 'old'){
                    $users = $this->users->where('parameters.age', '>=', 60);
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
            }
            if($explode[1] === 'sex'){
                if($value == 'male'){
                    $users = $this->users->where('parameters.sex', 'male');
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if($value == 'female'){
                    $users = $this->users->where('parameters.sex', 'female');
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if($value == 'other'){
                    $users = $this->users->where('parameters.sex', 'other');
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
            }
        }
    }

    public function setFilters(){
        if(!empty($exam = data_get($this->filters, 'exam_type_id'))){
            $this->examsType = $this->examsType->find($exam);
        }
        if(!empty($age = data_get($this->filters, 'age'))){
            if($age == 'young'){
                $users = $this->users->whereBetween('parameters.age', [0, 19]);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if($age == 'adult'){
                $users = $this->users->whereBetween('parameters.age', [20, 59]);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if($age == 'old'){
                $users = $this->users->where('parameters.age', '>=', 60);
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
        }
        if(!empty($age = data_get($this->filters, 'sex'))){
            if($age == 'male'){
                $users = $this->users->where('parameters.sex', 'male');
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if($age == 'female'){
                $users = $this->users->where('parameters.sex', 'female');
                $userIds = $users->pluck('id');
                $this->allExams = $this->allExams->whereIn('user_id', $userIds);
            }
            if($age == 'other'){
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
            data_set($data, 'data.pending', $this->allExams->pluck('id')->toArray());
            Study::create($data);
            return redirect()->action([FrontEndController::class, 'entitiesProfile']);
        } catch (\Exception $e) {
            dd($e);
            throw new Exception('Error');
        }
    }
}
