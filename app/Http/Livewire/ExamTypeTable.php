<?php

namespace App\Http\Livewire;

use App\Models\ExamType;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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
                ->hideIf(Auth::user()->data->role != 'manager')
                ->sortable()
                ->searchable(),
            Column::make(__('Titulo'), 'title')
                ->format(function ($value, $column, $model) {
                    $route = route('exam-type-show', ['id' => $column->id]);
                    return '<a href="' . $route . '">' . data_get($column, 'title') ?? '-' . '</a>';
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Grupo'), 'group')
                ->sortable()
                ->searchable(),
            Column::make(__('Criado a'), 'created_at')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->isoFormat('Y-MM-DD • HH:mm:ss');
                }),
            Column::make('Ações','id')
                ->format(function ($value, $column, $model) {
                    $html[] = '<a href="' . route('exam-type-remove', ['id' => $value]) . '" class="text-danger ms-3"><i class="fa fa-trash" aria-hidden="true"></i></a>';
//                    $html[] = '<a href="' . route('exam-type-show', ['id' => $value]) . '" class="ms-3"><i class="fa fa-eye" aria-hidden="true"></i></a>';
//                    $html[] = '<a href="' . route('exam-type-edit', ['id' => $value]) . '" class="text-danger ms-3"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                    return implode($html);
                })
                ->html(),
        ];

        return $columns;
    }
}
