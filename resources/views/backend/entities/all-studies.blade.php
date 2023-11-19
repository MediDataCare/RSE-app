@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Lista de Estudos</h2>
                <p>Todos os Estudos Registados na Plataforma pela Entidade <span class="fw-bold">{{$title}}</span> estão visíveis abaixo
                    <br>Estes podem ser Aprovados, Rejeitados e/ou Eliminados</p>
            </div>
            <livewire:study-table
                :entitiesId="$entitiesId"
            />
        </div>
    </div>
@endsection
