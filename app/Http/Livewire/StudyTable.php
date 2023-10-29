<?php

namespace App\Http\Livewire;

use App\Models\Study;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StudyTable extends DataTableComponent
{
    public function builder(): Builder
    {
        $query = Study::query();
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
                ->sortable()
                ->searchable(),
            Column::make(__('Estudo'), 'title')
                ->sortable()
                ->searchable(),
            Column::make(__('Estado'), 'state')
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
