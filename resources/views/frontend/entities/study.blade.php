@extends('theme.master')
@section('content')
    <div class="container-fluid">
        <div class="container py-5">
            <x-form-input action="show"
                          name="title"
                          :label="'Title'"
                          :placeholder="'Titulo'"
                          class="form-control mb-3"
                          :value="data_get($study, 'title')"
                          readonly
            />
            <x-form-textarea
                action="show"
                name="description"
                :label="'Descrição'"
                :placeholder="'Descrição'"
                class="form-control mb-3"
                :value="data_get($study, 'description')"
                readonly
            />
            <h5 class="text-center mt-5 mb-2">Dados escolhidos</h5>
            <h5 class="text-center mt-5 mb-2">{{ $allExams->count() . ' Resultados encontrados'}}</h5>
        </div>
    </div>
@endsection
