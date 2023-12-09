<div>
    <div class="container mt-5 mb-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Dado</th>
                <th scope="col">Estado</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($allData ?? [] as $studyId => $study)
                @foreach($study as $key => $value)
                    @php
                        $studyModel = data_get($study, 'study', []);
                        if($key === 'study'){
                            continue;
                        }
                    @endphp
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
                            <td>
                                @if(\Carbon\Carbon::parse(data_get($studyModel, 'data.duration_created'))->addDays(data_get($studyModel, 'data.duration')) <= \Carbon\Carbon::now())
                                    @if($state === 'Pendente')
                                        <span class="text-success ms-5">
                                        <i class="fa fa-check-circle"
                                           wire:click="purchaseData('{{ data_get($studyModel, 'id')}}', '{{data_get($exam, 'id') }}' , 'approved')"
                                           aria-hidden="true"></i>
                                    </span>
                                    @elseif($state === 'Aprovado')
                                        <span class="text-success ms-5">
                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                    </span>
                                    @endif
                                    @if($state === 'Pendente')
                                        <span class="text-danger ms-5">
                                    <i class="fa fa-ban ms-2"
                                       wire:click="purchaseData('{{ data_get($studyModel, 'id')}}', '{{data_get($exam, 'id') }}' , 'rejected')"
                                       aria-hidden="true"></i>
                                    </span>
                                    @elseif($state === 'Rejeitado')
                                        <span class="text-danger ms-5">
                                    <i class="fa fa-ban ms-2"
                                       aria-hidden="true"></i>
                                    </span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>
