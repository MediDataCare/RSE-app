@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Lista de Formulário</h2>
                <p>Aqui pode ver a lista de todos os formulários criados.</p>
            </div>
            <div class="container mt-5">
                <div class="btn-form mb-3">
                    <a href="{{route('exam-type-create')}}">
                        {{'Criar formulário'}}
                    </a>
                </div>
                <livewire:exam-type-table
                />
            </div>
        </div>
    </div>
@endsection
