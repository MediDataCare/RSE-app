@extends('theme.master')
@section('content')
    @if (Auth::check() && Auth::user()->data->role == 'user')
        <div class="container-fluid">
            <div class="section-header mt-5" style="margin-top:7rem!Important">
                <h2>Perfil</h2>
                <p>Aqui pode verificar e alterar os seus dados do seu Perfil</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mt-1 mb-1 alert profile">
                        <div class=" ">
                            <strong>Nome:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            <strong>E-mail:</strong> {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5 mb-5">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                    <livewire:exam-table
                    />
                @endif
            </div>
        </div>
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
