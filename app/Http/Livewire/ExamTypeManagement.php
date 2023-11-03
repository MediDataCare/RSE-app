<?php

namespace App\Http\Livewire;

use App\Http\Controllers\BackOfficeController;
use Exception;
use Livewire\Component;
use App\Models\ExamType;

class ExamTypeManagement extends Component
{

    public $inputs = [];
    public $title;
    public $group;
    public $allExamsParams;

    public $addGroup = false;

    public function mount()
    {
        if(!empty($this->examType)){
            $this->title = data_get($this->examType, 'title');
//            $this->examTag = data_get($this->examType, 'description');
            $this->inputs = data_get($this->examType, 'parameters', []);
        }

        $this->inputs = [
            'type' => '',
            'options' =>  []
        ];

        $this->allExamsParams = ExamType::pluck('group', 'group')->unique();
    }


    public function render()
    {
        return view('backend.exam_type.Livewire.form');
    }

    public function addOptions()
    {
        $options = data_get($this->inputs,'options.options', []);
        array_push($options, '');
        data_set($this->inputs, 'options.options', $options);
    }

    public function addGroup()
    {
        $this->addGroup = true;
    }

    public function storeData()
    {
        try {
            $data = [];
            $data['title'] = $this->title;
            $data['group'] = $this->group;
            $data['parameters'] = [];
            foreach (data_get($this->inputs, 'options') as $name => $input) {
                data_set($data['parameters'], $name, $input);
            }
            data_set($data['parameters'], 'type', data_get($this->inputs, 'type'));
            ExamType::create($data);
            return redirect()->action([BackOfficeController::class, 'indexExameType']);

        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }
}
