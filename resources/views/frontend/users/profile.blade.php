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
            <hr class="my-4">
            <h4 class="text-center mt-5 mb-4 fw-bold">Histórico de Dados</h4>
            <div class="container mt-5 mb-5">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                    <livewire:exam-table
                    />
                @endif
            </div>
            @php
                $exams = \App\Models\Exam::where('user_id', Auth::user()->id)->get();
                $studies = \App\Models\Study::where('state', 'approved')->get();

                $allData = $studies->map(function ($study) use ($exams) {
                    $studyPendingExams = $exams->filter(function ($exam) use ($study) {
                        return in_array($exam->id, data_get($study, 'data.pending', []));
                    });
                    $studyApprovedExams = $exams->filter(function ($exam) use ($study) {
                        return in_array($exam->id, data_get($study, 'data.approved', []));
                    });
                    $studyRejectedExams = $exams->filter(function ($exam) use ($study) {
                        return in_array($exam->id, data_get($study, 'data.rejected', []));
                    });

                    return ['pending' => $studyPendingExams->toArray(), 'approved' => $studyApprovedExams->toArray(), 'rejected' => $studyRejectedExams->toArray()];

                });
            @endphp
            <hr class="my-4">
            <h4 class="text-center mt-5 mb-4 fw-bold">Lista de Pedidos</h4>
            <div class="container mt-5 mb-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Dado</th>
                        <th scope="col">Estado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allData ?? [] as $study)
                        @foreach($study as $key => $value)
                            @foreach($value as $exam)
                                <tr>
                                    <td>{{data_get($exam, 'parameters.name', '-')}}</td>
                                    @php
                                        $state = 'Pendente';
                                            if( $key ==='pending'){
                                                $state = 'Pendente';
                                            }elseif( $key ==='approved'){
                                                $state = 'Aprovado';
                                            }elseif( $key ==='rejected'){
                                                $state = 'Rejeitado';
                                            }
                                    @endphp
                                    <td>{{ $state }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
