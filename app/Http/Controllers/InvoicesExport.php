<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Models\Study;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoicesExport implements FromView, WithStyles, ShouldAutoSize
{
    protected $study;
    protected $totalColumns;

    public function __construct($study)
    {
        $this->study = $study;
    }

    public function view(): View
    {
        $study = Study::find($this->study);

        // TEMOS DE DEFINIR O Nº TOTAL DE COLUNAS
        $columns = ['Identificação do Utilizador', 'Idade', 'Sexo', 'Distrito'];
        $exams = \App\Models\Exam::whereIn('id', data_get($study, 'data.pending', []))->get();
        $examsTypes = \App\Models\ExamType::whereIn('id', \App\Models\Exam::whereIn('id', data_get($study, 'data.pending', []))->pluck('exams_types_id')->unique()->toArray())->get();
        foreach($examsTypes as $type){
            $params = data_get($type, 'parameters', []);
            if(data_get($params, 'type') === 'select'){
                array_push($columns, data_get($type, 'title'));
                array_push($columns, 'respostas');
            }elseif(data_get($params, 'type') === 'number' && !empty($options = data_get($params, 'options', []))){
                array_push($columns, data_get($type, 'title'));
                foreach ($options as $value){
                    array_push($columns, $value);
                }
            }else{
                array_push($columns, data_get($type, 'title'));
                array_push($columns, 'respostas');
            }
        }
        return view('frontend.entities.export', [
            'study' => $study,
            'totalColumns' => count($columns),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'italic' => true,
                    'size' => 16,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,
                    ],
                ],
            ],
            2 => [
                'font' => [
                    'size' => 13,
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                    'top' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,
                    ],
                ],
            ],
            4 => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                ],
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                    'inside' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    ],
                ],
            ],
        ];
    }

}
