<?php

namespace App\Http\Livewire;

use App\Http\Controllers\BackOfficeController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Auth;

class EntitiesTable extends DataTableComponent
{

    public function builder() : Builder {
        $users = User::all();
       return $users->filter(function ($item){
            if (data_get($item, 'data.role') === 'entitie')
                return $item;
        })->toQuery();
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
            Column::make(__('Nome'), 'name')
                ->format(function ($value, $column, $model) {
                    $route = route('all-studies', ['entitiesId' => $column->id]);
                    return '<a href="' . $route . '">' . data_get($column, 'name') ?? '-' . '</a>';
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Email'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(__('Criado a'), 'created_at')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->isoFormat('Y-MM-DD • HH:mm:ss');
                }),
            Column::make(__('Estado'), 'state')
                ->format(function ($value) {
                    if($value === 'rejected')
                        return 'Rejeitado';
                    else
                        return 'Aprovado';
                })
                ->sortable()
                ->searchable(),
            Column::make('Aprovar/Rejeitar','id')
                ->format(function ($value, $column, $model) {
                    $entitie = User::find($value);
                    if(data_get($entitie, 'state') === 'rejected')
                        $html[] = '<a href="' . route('aproveEntitie', ['id' => $value]) . '" class="text-success ms-2"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                    elseif(data_get($entitie, 'state') === 'approved')
                        $html[] = '<a href="' . route('rejectEntitie', ['id' => $value]) . '" class="text-danger ms-2"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                    else
                        $html[] = '<a href="' . route('aproveEntitie', ['id' => $value]) . '" class="text-success ms-2"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                        $html[] = '<a href="' . route('rejectEntitie', ['id' => $value]) . '" class="text-danger ms-2"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                    return implode($html);
                })
                ->html()
        ];

        return $columns;
    }
}
