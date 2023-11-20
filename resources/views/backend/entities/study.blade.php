@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Características do Estudo</h2>
                <!-- <p>Todas as Entidades Registadas na Plataforma estão visíveis abaixo, o seu registo pode ser Aprovado ou Rejeitado
                    <br>Para observar os Estudos de uma Entidade por favor selecione a mesma</p> -->
            </div>
            <div class="row mb-3">
                <div class="col-6 d-flex align-items-center ">
                    <a href="#">
                        <i class="fas fa-arrow-left fs-4"></i>
                    </a>
                </div>
                @if(empty(data_get($study, 'data.accepted', [])) && empty(data_get($study, 'data.rejected', [])))
                    <div class="col-6 text-end btn-form">
                        <button onclick="window.location.href='{{ route('edit-study', ['id' => $study->id]) }}'">
                            {{ 'Editar Estudo' }}
                        </button>
                    </div>
                @endif
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
            <h4 class="text-center mt-5 mb-3 fw-bold">Dados escolhidos</h4>
            <h5 class="text-center mt-4 mb-2">
                {{ ' Resultados encontrados: ' }} 
                <span class="text-success fw-bold">{{ $allExams->count() }}</span>
            </h5>
        </div>
    </div>
@endsection
