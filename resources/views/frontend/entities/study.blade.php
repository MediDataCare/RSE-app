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
                <div class="section-header">
                    <h2>Características do Estudo</h2>
                </div>
                <div class="row mb-3">
                    <div class="col-6 d-flex align-items-center ">
                        <a href="/entitie/profile">
                            <i class="fas fa-arrow-left fs-4"></i>
                        </a>
                    </div>
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
                    <x-form-textarea
                        action="show"
                        name="description"
                        :label="'Descrição'"
                        :placeholder="'Descrição'"
                        class="form-control mb-3"
                        :default="data_get($study, 'description')"
                        style="resize: none;"
                        readonly
                    />
                </b>
                <h4 class="text-center mt-5 mb-3 fw-bold">Dados escolhidos</h4>
                @php
                    $examsIds = array_merge((array)data_get($study, 'data.pending', []), (array)data_get($study, 'data.approved', []), (array)data_get($study, 'data.rejected', []));
                    $allExams = \App\Models\Exam::whereIn('id', $examsIds)->get();
                @endphp
                <h5 class="text-center mt-4 mb-2">
                    {{ ' Resultados encontrados: ' }}
                    <span class="text-success fw-bold">{{ $allExams->count()}}</span>
                </h5>
                @php
                    $approved = \App\Models\Exam::whereIn('id', data_get($study, 'data.approved', []))->get();
                @endphp
                <h5 class="text-center mt-4 mb-2">
                    {{ ' Resultados Aceites: ' }}
                    <span class="text-success fw-bold">{{ $approved->count()}}</span>
                </h5>
                @if(\Carbon\Carbon::parse(data_get($study, 'data.duration_created'))->addDays(data_get($study, 'data.duration')) <= \Carbon\Carbon::now() && (data_get($study, 'data.expected_Exams') <= data_get($study, 'data.approved')))
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{ route('export', ['id' => $study]) }}" class="btn btn-success mt-4 mb-2">
                        <i class="fas fa-file-excel"></i> Descarregar Ficheiro
                    </a>
                </div>
                @endif
            </div>
        </div>
    @endif
@endsection
