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
    public $examType;
    public $action;
    public $addGroup = false;

    public function mount()
    {
        if(!empty($this->examType)){
            $this->title = data_get($this->examType, 'title');
            $this->group = data_get($this->examType, 'group');

            if(data_get($this->examType, 'parameters.type') === 'number'){
                $this->inputs = [
                    'type' => data_get($this->examType, 'parameters.type'),
                    'options' =>  [
                        'unit' => data_get($this->examType, 'parameters.unit', ''),
                        'max-number' => data_get($this->examType, 'parameters.max-number', ''),
                        'min-number' => data_get($this->examType, 'parameters.min-number', ''),
                    ]
                ];
            }else{
                $this->inputs = [
                    'type' => data_get($this->examType, 'parameters.type'),
                    'options' =>  [
                        'options' => data_get($this->examType, 'parameters.options', ''),
                    ]
                ];
            }
        }else{
            $this->inputs = [
                'type' => '',
                'options' =>  []
            ];
        }



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
            $this->examType = ExamType::create($data);
            return redirect()->action([BackOfficeController::class, 'showExamType'], ['id' => data_get($this->examType, 'id')]);

        } catch (\Exception $e) {
            dd($e);
            throw new Exception('Error');
        }
    }

    public function updateData()
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
            $this->examType->update($data);
            return redirect()->action([BackOfficeController::class, 'showExamType'], ['id' => data_get($this->examType, 'id')]);

        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }

    public function removeInput($position)
    {
        unset($this->inputs['options']['options'][$position]);
    }
}
