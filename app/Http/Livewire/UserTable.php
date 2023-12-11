<?php

namespace App\Http\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UserTable extends DataTableComponent
{

    public function builder() : Builder {
        return User::query();
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
                    $route = route('users-edit', ['id' => $column->id]);
                    return '<a href="' . $route . '">' . data_get($column, 'name') ?? '-' . '</a>';
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Email'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(__('Role'), 'data')
                ->format(function ($value, $column, $model) {
                    $roleKey = data_get($column, 'data.role');
                    $rolesTranslations = [
                        'admin' => __('Administrador'),
                        'manager' => __('Gestor'),
                        'entitie' => __('Entidade'),
                        'user' => __('Utilizador'),
                    ];
                    return $rolesTranslations[$roleKey] ?? '-';
                })
                ->sortable()
                ->searchable()
        ];

        return $columns;
    }
}
