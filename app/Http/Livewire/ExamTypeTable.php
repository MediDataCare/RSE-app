<?php

namespace App\Http\Livewire;

use App\Models\ExamType;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;


class ExamTypeTable extends DataTableComponent
{

    public function builder() : Builder {
        return ExamType::query();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns() : array {
        $columns = [
            Column::make(__('ID'), 'id')
                ->sortable()
                ->searchable(),
            Column::make(__('Titulo'), 'title')
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Descrição'), 'description')
                ->sortable()
                ->searchable(),
            Column::make(__('Criado a'), 'created_at')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->isoFormat('Y-MM-DD • HH:mm:ss');
                })
        ];

        return $columns;
    }


}
