@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Lista de Utilizadores</h2>
                <p>Todos os Utilizadores existentes na Plataforma estão disponíveis abaixo, podem ser Alteradas as suas roles
                    <br>Para Alterar a role de um Utilizador por favor selecione o mesmo e valide os parâmetros definidos</p>
            </div>
            <div class="container mt-5">
                <div class="btn-form mb-3">
                                      
                </div>
                <livewire:user-table
                />
            </div>
        </div>
    </div>
@endsection