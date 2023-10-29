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
    public $description;

    public function mount()
    {
        if(!empty($this->examType)){
            $this->title = data_get($this->examType, 'title');
            $this->description = data_get($this->examType, 'description');
            $this->inputs = data_get($this->examType, 'parameters', []);
        }
    }


    public function render()
    {
        return view('backend.exam_type.Livewire.form');
    }

    public function addInput()
    {
        $this->inputs[] = [
            'title' => '',
            'type' => '',
            'options' =>  ['']
        ];
    }

    public function addOptions($key)
    {
        $options = data_get($this->inputs, $key.'.options');
        array_push($options, '');
        data_set($this->inputs, $key.'.options', $options);
    }

    public function removeInput($position)
    {
        unset($this->inputs[$position]);
    }

    public function storeData()
    {
        try {
            $data = [];
            $data['title'] = $this->title;
            $data['description'] = $this->description;
            $data['parameters'] = [];
            foreach ($this->inputs as $input) {
                array_push($data['parameters'], $input);
            }
            ExamType::create($data);
            return redirect()->action([BackOfficeController::class, 'indexExameType']);

        } catch (\Exception $e) {
            throw new Exception('Error');
        }
    }
}
