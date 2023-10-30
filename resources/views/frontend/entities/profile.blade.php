@extends('theme.master')
@section('content')
    <div class="container-fluid">
        <div class="section-header mt-5" style="margin-top:7rem!Important">
            <h2>Perfil</h2>
            <p>Aqui pode verificar e alterar os seus dados da sua Entidade</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-1 mb-1 alert profile">
                    <div class="">
                        <strong>Nome:</strong> {{ Auth::user()->name }}
                    </div>
                    <div class="">
                        <strong>Cae:</strong> {{ Auth::user()->email }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-4">
                    <a href="" class=" profile_route"><i class="fas fa-search-plus"></i> Criar Estudo</a>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                <livewire:study-table
                />
            @endif
        </div>
    </div>
@endsection
