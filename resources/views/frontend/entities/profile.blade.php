@php
    use App\Models\User;
@endphp
@extends('theme.master')
@section('content')
    @if (Auth::check() && (Auth::user()->data->role == 'entitie' || !empty(Auth::user()->data->entitie)))
        <div class="container-fluid">
            <div class="section-header mt-5" style="margin-top:7rem!Important">
                <h2>Perfil</h2>
                <p>Faça a Gestão dos seus Estudos</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mt-1 mb-1 alert profile">
                        <div class="">
                            <strong>Nome:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            @if(Auth::user()->data && isset(Auth::user()->data->entitie))
                                @php
                                    $entityUser = User::find(Auth::user()->data->entitie);
                                @endphp
                        
                                <strong>Entidade:</strong> {{ $entityUser ? $entityUser->name : 'Usuário da entidade não encontrado' }}
                            @else
                                <strong>NIF:</strong> {{ Auth::user()->parameters->cae }}
                            @endif
                        </div>
                        <div class="">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5 mb-5">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                    <livewire:study-table
                        :user="Auth::user()"
                    />
                @endif
            </div>
            @if(data_get(\Illuminate\Support\Facades\Auth::user(), 'data.role') === 'entitie')
                <div class="container border border-dark shadow py-4 mb-5 rounded-4 px-4">
                    <!-- <h3 class="fw-bold">Utilizadores associados à entidade</h3
                    <p class="text-center mt-3">Faça a Gestão dos seus Estudos</p> -->
                    <h4 class="text-center fw-bold">Associar Utilizador ao seu Perfil</h4>
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

    @else
        <script>window.location = "/";</script>
    @endif
@endsection
