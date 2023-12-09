<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\Study;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PurchaseData extends Component
{
    public $allData;
    public function mount()
    {
    }

    public function render()
    {
        return view('frontend.entities.Livewire.purchase-data');
    }

    public function purchaseData($studyId,$examId, $state){
        $study = Study::find($studyId);
        $exam = Exam::find($examId);
        $data = data_get($study, 'data', []);
        $pending = data_get($data, 'pending', []);
        $index = array_search(data_get($exam, 'id'), $pending);
        unset($pending[$index]);
        data_set($data, 'pending', $pending);

        if($state === 'approved'){
            $approved = data_get($data, 'approved', []);
            array_push($approved, data_get($exam, 'id'));
            data_set($data, 'approved', $approved);

        }

        if($state === 'rejected'){
            $rejected = data_get($data, 'rejected', []);
            array_push($rejected, data_get($exam, 'id'));
            data_set($data, 'rejected', $rejected);
        }

        $study->update(['data' => $data]);
    }
}
