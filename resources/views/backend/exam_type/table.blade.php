@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Lista de Dados</h2>
                <p>Todos os Dados existentes na Plataforma estão disponíveis abaixo, podem ser Removidos ou Alterados 
                    <br>Para Alterar um Dado por favor selecione o mesmo e valide os parâmetros definidos</p>
            </div>
            <div class="container mt-5">
                <div class="btn-form mb-3">
                    <button onclick="window.location.href='{{ route('exam-type-create') }}'">
                        {{ 'Criar Dado' }}
                    </button>                    
                </div>
                <livewire:exam-type-table
                />
            </div>
        </div>
    </div>
@endsection
