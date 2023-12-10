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
use Illuminate\Support\Str;
use Carbon\Carbon;


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
    public $selectExam;
    public $selectOption;
    public $selectMinMax;

    public $locals = [
        "Aveiro" => "Aveiro",
        "Beja" => "Beja",
        "Braga" => "Braga",
        "Bragança" => "Bragança",
        "Castelo Branco" => "Castelo Branco",
        "Coimbra" => "Coimbra",
        "Évora" => "Évora",
        "Faro" => "Faro",
        "Guarda" => "Guarda",
        "Leiria" => "Leiria",
        "Lisboa" => "Lisboa",
        "Madeira" => "Madeira",
        "Portalegre" => "Portalegre",
        "Porto" => "Porto",
        "Santarém" => "Santarém",
        "Setúbal" => "Setúbal",
        "Viana do Castelo" => "Viana do Castelo",
        "Vila Real" => "Vila Real",
        "Viseu" => "Viseu"
    ];

    public function mount()
    {

        if (!empty($this->study)) {
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

    public function saveFilter()
    {
        $this->filters[$this->selectExam]['exams']['id'] = $this->selectExam;
        foreach ($this->examsTypeOptions as $key => $exam) {
            unset($exam[$this->selectExam]);
            $this->examsTypeOptions[$key] = $exam;
        }
        $this->examsType = $this->examsType->whereIn('id', data_get($this->filters, 'exams'));
        $this->allExams = $this->allExams->whereIn('exams_types_id', $this->examsType->pluck('id')->toArray());
        if (!empty($this->selectOption)) {
            $this->filters[$this->selectExam]['exams']['options'] = $this->selectOption;
        }

        if (is_array($this->selectMinMax)) {
            $this->filters[$this->selectExam]['exams']['options'] = $this->selectMinMax;
        }
//        $this->dispatchBrowserEvent('closeModal');
        $this->resetList();
        $this->selectExam = '';
        $this->selectOption = '';
        $this->selectMinMax = '';
    }

    public function removeFromFilter($id)
    {
        unset($this->filters[$id]);
        $this->selectExam = 'default';
        $this->resetList();
    }

    public function updating($property, $value)
    {
        $explode = explode('.', $property);
        if ($explode[0] === 'filters') {
            data_set($this->filters, $explode[1], $value);
        }
        $this->resetList();
    }

    public function setFilters()
    {
        if (!empty($this->filters)) {
            $ids = [];
            foreach ($this->filters as $filter) {
                array_push($ids, data_get($filter, 'exams.id'));
            }
            if (!empty(array_filter($ids))) {
                $this->examsType = $this->examsType->whereIn('id', $ids);
                $this->allExams = $this->allExams->whereIn('exams_types_id', $this->examsType->pluck('id')->toArray());
            }
            $examsIds = [];
            foreach ($this->filters as $filter) {
                if (!empty($filter) && !empty($gender = data_get($this->filters, 'sex'))) {
                    $userIds = [];
                    foreach ($gender as $value) {
                        if ($value == 'male') {
                            $userIds = array_merge($userIds, $this->users->where('parameters.sex', 'male')->pluck('id')->toArray());
                        }
                        if ($value == 'female') {
                            $userIds = array_merge($userIds, $this->users->where('parameters.sex', 'female')->pluck('id')->toArray());
                        }
                        if ($value == 'other') {
                            $userIds = array_merge($userIds, $this->users->where('parameters.sex', 'other')->pluck('id')->toArray());
                        }
                    }
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if (!empty($filter) && !empty($locals = data_get($this->filters, 'local'))) {
                    $userIds = [];
                    foreach ($locals as $value) {
                        $userIds = array_merge($userIds, $this->users->where('parameters.local', $value)->pluck('id')->toArray());
                    }
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if (!empty($filter) && !empty(data_get($this->filters, 'age_min'))) {
                    $users = $this->users->where('parameters.age', '>=', data_get($this->filters, 'age_min'));
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }
                if ((!empty($filter) && !empty(data_get($this->filters, 'age_max')))) {
                    $users = $this->users->where('parameters.age', '<=', data_get($this->filters, 'age_max'));
                    $userIds = $users->pluck('id');
                    $this->allExams = $this->allExams->whereIn('user_id', $userIds);
                }

                if (!empty(data_get($filter, 'exams'))) {
                    $options = data_get($filter, 'exams.options');
                    if (!is_array($options)) {
                        if (!empty($options)) {
                            $opt = $options;
                            $examsIds = $this->allExams->filter(function ($item) use ($opt) {
                                $explode = explode('-', $opt);
                                if (data_get($item, 'parameters.' . Str::slug($explode[0])) === $explode[1]) {
                                    return $item;
                                }
                            })->pluck('id')->toArray();
                            $this->allExams = $this->allExams->whereIn('id', $examsIds);
                        }
                    }
                    if (is_array($options)) {
                        if (!empty(array_filter($options))) {
                            $opts = $options;
                            $id = data_get($filter, 'exams.id');
                            $examsTypes = $this->examsType;
                            $pluckIds = $this->allExams->filter(function ($item) use ($opts, $examsTypes, $id) {
                                if (data_get($item, 'exams_types_id') === $id) {
                                    $examType = $examsTypes->where('id', $id)->first();
                                    $return = false;
                                    $itemParams = data_get($item, 'parameters.' . strtolower(data_get($examType, 'title')));
                                    if (is_array($itemParams)) {
                                        foreach ($itemParams ?? [] as $paramName => $param) {
                                            $min = data_get($opts, $paramName . '_min');
                                            $max = data_get($opts, $paramName . '_max');
                                            if (data_get($itemParams, $paramName) >= $min && data_get($itemParams, $paramName) <= $max) {
                                                $return = true;
                                            } else {
                                                $return = false;
                                            }
                                        }
                                    } else {
                                        $min = data_get($opts, strtolower(data_get($examType, 'title')) . '_min');
                                        $max = data_get($opts, strtolower(data_get($examType, 'title')) . '_max');
                                        if ($itemParams >= $min && $itemParams <= $max) {
                                            $return = true;
                                        } else {
                                            $return = false;
                                        }
                                    }
                                    if ($return) {
                                        return $item;
                                    }
                                }
                            })->pluck('id')->toArray();
                            $examsIds = array_merge($examsIds, $pluckIds);
                            $this->allExams = $this->allExams->whereIn('id', $examsIds);
                        }
                    }
                }
            }
        }
    }

    public
    function storeStudy()
    {
        try {
            $user = Auth::user();

            $data = [];
            $data['title'] = data_get($this->inputs, 'title', '-');
            $data['description'] = data_get($this->inputs, 'description', '-');
            $data['state'] = 'pending';
            $data['user_id'] = empty($user) ? 0 : $user->id;;
            $data['data'] = [];
            data_set($data, 'data.filters', $this->filters);
            data_set($data, 'data.duration', data_get($this->inputs, 'duration', 0));
            data_set($data, 'data.duration_created', Carbon::now());
            data_set($data, 'data.expected_Exams', data_get($this->inputs, 'expected_Exams'));
            data_set($data, 'data.pending', $this->allExams->pluck('id')->toArray());
            Study::create($data);
            return redirect()->action([FrontEndController::class, 'entitiesProfile']);
        } catch (\Exception $e) {
            dd($e);
            throw new Exception('Error');
        }
    }

    public
    function updateStudy()
    {
        try {
            $user = Auth::user();

            $data = [];
            $data['title'] = data_get($this->inputs, 'title');
            $data['description'] = data_get($this->inputs, 'description');
            $data['user_id'] = empty($user) ? 0 : $user->id;;
            $data['data'] = [];
            $data['data'] = data_get($this->study, 'data');
            data_set($data, 'data.filters', $this->filters);
            if (data_get($this->study, 'data.duration') != data_get($this->inputs, 'duration')) {
                data_set($data, 'data.duration', data_get($this->inputs, 'duration', 0));
                data_set($data, 'data.duration_created', Carbon::now());
            }
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
