@php
    use App\Models\User;
@endphp
@extends('theme.master')
@section('content')
    @if (Auth::check() && (Auth::user()->data->role == 'entitie' || !empty(Auth::user()->data->entitie)))
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
                <div class="container">
                    <h3 class="fw-bold">Utilizadores associados à entidade</h3>
                    <livewire:add-users
                        :entitie="Auth::user()"
                    />
                </div>
            @endif
        </div>

    @else
        <script>window.location = "/";</script>
    @endif
@endsection
