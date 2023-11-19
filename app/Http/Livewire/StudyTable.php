<?php

namespace App\Http\Livewire;

use App\Models\Study;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StudyTable extends DataTableComponent
{
    public $user;
    public $entitiesId;
    public function builder(): Builder
    {
        $query = Study::query();
        $users = User::all();
        if(data_get($this->user, 'data.role') != 'entitie'){
            $entitie = $users->find(data_get($this->user, 'data.entitie'));
        }else{
            $entitie = $this->user;
        }
        $entitieUsers = $users->filter(function ($item) use ($entitie) {
                if(data_get($item, 'data.entitie') === $entitie->id){
                    return $item;
                }
        })->pluck('id')->toArray();
        array_push($entitieUsers, $entitie->id);
        if(!empty($this->user))
            $query =  $query->whereIn('user_id', $entitieUsers);
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
            Column::make(__('Nome'), 'user_id')
                ->format(function ($value, $column, $model) {
                    $user = User::find($value);
                    return data_get($user, 'name','-');
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Estudo'), 'title')
                ->format(function ($value, $column, $model) {
                    $route = route('show-study', ['id' => $column->id]);
                    return '<a href="' . $route . '">' . data_get($column, 'title') ?? '-' . '</a>';
                })
                ->html()
                ->sortable()
                ->searchable(),
            Column::make(__('Estado'), 'state')
                ->format(function ($value) {
                    if($value === 'rejected')
                        return 'Rejeitado';
                    elseif($value === 'approved')
                        return 'Aprovado';
                    else
                        return 'Pendente';
                })
                ->sortable()
                ->searchable(),
            Column::make(__('Criado a'), 'created_at')
                ->searchable()
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->isoFormat('Y-MM-DD • HH:mm:ss');
                }),
            Column::make('Aprovar/Rejeitar','id')
                ->hideIf(!empty($this->user))
                ->format(function ($value, $column, $model) {
                    $study = Study::find($value);
                    if(data_get($study, 'state') === 'rejected'){
                        $html[] = '<a href="' . route('aprove-study', ['entitiesId' => $this->entitiesId ,'id' => $value]) . '" class="text-success ms-5"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                    }elseif(data_get($study, 'state') === 'approved'){
                        if(empty(data_get($study, 'data.accepted', [])) && empty(data_get($study, 'data.rejected', []))){
                            $html[] = '<a href="' . route('reject-study', ['entitiesId' => $this->entitiesId ,'id' => $value]) . '" class="text-danger ms-5"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                        }else{
                            $html[] = '<a title="Não é possivel rejeitar este estudo" class="text-secondary ms-5"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                        }
                    }else{
                        $html[] = '<a href="' . route('aprove-study', ['entitiesId' => $this->entitiesId ,'id' => $value]) . '" class="text-success ms-5"><i class="fa fa-check-circle" aria-hidden="true"></i></a>';
                        $html[] = '<a href="' . route('reject-study', ['entitiesId' => $this->entitiesId ,'id' => $value]) . '" class="text-danger ms-2"><i class="fa fa-ban" aria-hidden="true"></i></a>';
                    }

                    return implode($html);
                })
                ->html(),
        ];

        return $columns;
    }
}
