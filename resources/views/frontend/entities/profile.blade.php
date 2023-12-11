@php
    use App\Models\User;
@endphp
@extends('theme.master')
@section('content')
        <div class="container-fluid">
            <div class="section-header mt-5" style="margin-top:7rem!Important">
                <h2>Perfil</h2>
                <p>Faça a Gestão dos seus Estudos</p>
            </div>
            <!-- <h4 class="text-center mt-5 mb-4 fw-bold">Informação Geral</h4> -->
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mt-1 mb-5 alert profile shadow rounded-4">
                        <div class="">
                            <strong>Nome:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            @if(Auth::user()->data && isset(Auth::user()->data->entitie))
                                @php
                                    $entityUser = User::find(Auth::user()->data->entitie);
                                @endphp
                        
                                <strong>NIF da Entidade:</strong> {{ $entityUser ? $entityUser->parameters->cae : 'NIF da entidade não encontrado' }}
                            @else
                                <strong>NIF da Entidade:</strong> {{ optional(Auth::user()->parameters)->cae }}
                            @endif
                        </div>
                        <div class="">
                            
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h4 class="text-center mt-5 mb-4 fw-bold">Meus Estudos</h4>
            <div class="container mt-5 mb-5">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                    <livewire:study-table
                        :user="Auth::user()"
                    />
                @endif
            </div>
            @if(data_get(\Illuminate\Support\Facades\Auth::user(), 'data.role') === 'entitie')
                <hr class="my-4">
                <h4 class="text-center mt-5 mb-4 fw-bold">Gestão de Utilizadores</h4>
                <div class="container border border-dark shadow py-4 mb-5 rounded-4 px-4 associa_user">
                    <!-- <h3 class="fw-bold">Utilizadores associados à entidade</h3
                    <p class="text-center mt-3">Faça a Gestão dos seus Estudos</p> -->
                    <h4 class="text-center">Associar Utilizador ao seu Perfil</h4>
                    <livewire:add-users
                        :entitie="Auth::user()"
                    />             
                    <div class="text-end btn-form mt-1 px-2">
                        <button  class="btn-form" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-user-plus"></i>
                            Adicionar
                        </button>
                    </div>
                </div>
            @endif
        </div>
@endsection
