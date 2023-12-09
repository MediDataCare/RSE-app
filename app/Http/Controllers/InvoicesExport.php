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
        // NAO SEI COMO
        $this->totalColumns = 8;

        return view('frontend.entities.export', [
            'study' => $study,
            'totalColumns' => $this->totalColumns,
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


class InvoicesController extends Controller
{
    public function export(Request $request)
    {
        $study = Study::find($request->study_id);

        $export = new InvoicesExport($study);

        $styles = $export->styles();

        return Excel::download($invoices, $filename, $styles);
    }
}

/*
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
*/