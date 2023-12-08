<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Models\Study;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class InvoicesExport implements FromView
{
    protected $study;

    public function __construct($study)
    {
        $this->study = $study;
    }

    public function view(): View
    {
        $study = Study::find($this->study);

        return view('frontend.entities.export', [
            'study' => $study
        ]);
    }
}
