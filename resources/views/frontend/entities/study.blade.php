@extends('theme.master')
@section('content')
    @if($action != 'show')
        <livewire:entitie-form
            :action="$action"
            :study="$study"
        />
    @else
        <div class="container-fluid mt-5">
            <div class="container py-5">
                @if(empty(data_get($study, 'data.accepted', [])) && empty(data_get($study, 'data.rejected', [])))
                    <div class="btn-form mb-3">
                        <button onclick="window.location.href='{{ route('edit-study', ['id' => $study->id]) }}'">
                            {{ 'Editar Dado' }}
                        </button>
                    </div>
                @endif
                <div class="section-header">
                    <h2>Características do Estudo</h2>
                    <!-- <p>Todas as Entidades Registadas na Plataforma estão visíveis abaixo, o seu registo pode ser Aprovado ou Rejeitado
                        <br>Para observar os Estudos de uma Entidade por favor selecione a mesma</p> -->
                </div>
                <b>
                    <x-form-input action="show"
                                  name="title"
                                  :label="'Título'"
                                  :placeholder="'Titulo'"
                                  class="form-control mb-3"
                                  :value="data_get($study, 'title')"
                                  readonly
                    />
                </b>
                <b>
                    <x-form-input
                        action="show"
                        name="description"
                        :label="'Descrição'"
                        :placeholder="'Descrição'"
                        class="form-control mb-3"
                        :value="data_get($study, 'description')"
                        readonly
                    />
                </b>
                <h5 class="text-center mt-5 mb-2">Dados escolhidos</h5>
                <h5 class="text-center mt-5 mb-2">{{ $allExams->count() . ' Resultados encontrados'}}</h5>
            </div>
        </div>
    @endif
@endsection
