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
            <h5>Dados escolhidos</h5>

            <table class="table">
                <thead>
                <tr>
                    {{--                    <th scope="col"></th>--}}
                    <th scope="col">Tipo de dado</th>
                    <th scope="col">Idade (anos)</th>
                    <th scope="col">sexo</th>
                    <th scope="col">Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allExams ?? [] as $exam)
                    @php
                        $sexText = '-';
                        $sexCode = data_get($exam->examOwner(), 'parameters.sex');
                            if($sexCode == 'male')
                                $sexText = 'Masculino';
                            if($sexCode == 'female')
                                $sexText = 'Feminino';
                            if($sexCode == 'other')
                                $sexText = 'Outro';
                    @endphp
                    <tr>
                        <td>{{data_get($exam->examType()->first(), 'title', '-')}}</td>
                        <td>{{data_get($exam->examOwner(), 'parameters.age', '-')}}</td>
                        <td>{{$sexText}}</td>
                        @php
                            $state = 'Pendente';
                                if(in_array($exam->id, data_get($study, 'data.pending'))){
                                    $state = 'Pendente';
                                }elseif(in_array($exam->id, data_get($study, 'data.approved'))){
                                    $state = 'Aprovado';
                                }elseif(in_array($exam->id, data_get($study, 'data.rejected'))){
                                    $state = 'Rejeitado';
                                }
                        @endphp
                        <td>{{ $state }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
