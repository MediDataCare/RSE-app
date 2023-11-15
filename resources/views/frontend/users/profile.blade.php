@extends('theme.master')
@section('content')
    @if (Auth::check() && Auth::user()->data->role == 'user')
        <div class="container-fluid">
            <div class="section-header mt-5" style="margin-top:7rem!Important">
                <h2>Perfil</h2>
                <p>Aqui pode verificar e alterar os seus dados do seu Perfil</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mt-1 mb-1 alert profile">
                        <div class=" ">
                            <strong>Nome:</strong> {{ Auth::user()->name }}
                        </div>
                        <div class="">
                            <strong>E-mail:</strong> {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5 mb-5">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                    <livewire:exam-table
                    />
                @endif
            </div>
            @php
                $exams = \App\Models\Exam::where('user_id', Auth::user()->id)->get();
                $studies = \App\Models\Study::all();
//                $studies = $studies->map(function ($item) use ($exams) {
//                    $data = data_get($item, 'data.pending', []);
//
//                    // Use filter instead of map for filtering exams
//                    $newExams = $exams->filter(function ($exam) use ($data) {
//                        return in_array($exam->id, $data);
//                    });
//
//                    // Add a new key to the item with the filtered exams
//                    $item['filteredExams'] = $newExams;
//
//                    return $item;
//                });

                $allData = $studies->map(function ($study) use ($exams) {
                    $studyExams = $exams->filter(function ($exam) use ($study) {
                        return in_array($exam->id, data_get($study, 'data.pending'));
                    });

                    return [
                        'study_id' => $study->id,
                        'exams' => $studyExams->toArray(),
                    ];
                });
            @endphp

            <table class="table">
                <thead>
                <tr>
                    {{--                    <th scope="col"></th>--}}
                    <th scope="col">Estado</th>
                    <th scope="col">Tempo restante</th>
                    <th scope="col">Ação</th>
                </tr>
                </thead>
                <tbody>
                @foreach($studies ?? [] as $exam)
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
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
