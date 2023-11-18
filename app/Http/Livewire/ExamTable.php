<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Auth;

class ExamTable extends DataTableComponent
{
    public function builder(): Builder
    {
        $query = Exam::query();
        $query =  $query->where('user_id', Auth::user()->id);
        return $query;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        $columns = [
            Column::make(__('ID'), 'id')
                ->hideIf(Auth::user()->data->role != 'manager')
                ->sortable()
                ->searchable(),
            Column::make(__('Dado'), 'exams_types_id')
                ->format(function ($value, $column, $model) {
                    return data_get($column->examType,'title', '');
                })
                ->sortable()
                ->searchable(),
            Column::make(__('Criado a'), 'created_at')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->isoFormat('Y-MM-DD • HH:mm:ss');
                })/*,
            Column::make('')
                ->format(function ($value, $column, $model) {
                    dd($value, $column);
                    return data_get($column->examType,'group', '');
//                    return data_get($column->examType,'title', '');
                })
                ->sortable()
                ->searchable()*/
        ];

        return $columns;
    }
}
