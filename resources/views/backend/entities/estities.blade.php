@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Lista de Entidades</h2>
                <p>Todas as Entidades Registadas na Plataforma estão visíveis abaixo, o seu registo pode ser Aprovado ou Rejeitado 
                    <br>Para observar os Estudos de uma Entidade por favor selecione a mesma</p>
            </div>
            <livewire:entitie-table
            />
        </div>
    </div>
@endsection
