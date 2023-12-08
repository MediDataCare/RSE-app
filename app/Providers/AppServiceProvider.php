<?php

namespace App\Providers;

use App\Http\Livewire\AddEntitieUsers;
use App\Http\Livewire\EntitiesForm;
use App\Http\Livewire\EntitiesTable;
use App\Http\Livewire\ExamTable;
use App\Http\Livewire\ExamTypeManagement;
use App\Http\Livewire\ExamTypeTable;
use App\Http\Livewire\StudyTable;
use App\Http\Livewire\UserForm;
use App\Http\Livewire\UserTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('entitie-form', EntitiesForm::class);
        Livewire::component('user-form', UserForm::class);
        Livewire::component('exam-type-form', ExamTypeManagement::class);
        Livewire::component('exam-type-table', ExamTypeTable::class);
        Livewire::component('exam-table', ExamTable::class);
        Livewire::component('study-table', StudyTable::class);
        Livewire::component('entitie-table', EntitiesTable::class);
        Livewire::component('add-users', AddEntitieUsers::class);
        Livewire::component('user-table', UserTable::class);
    }
}
