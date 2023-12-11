<table>
    @php
        $exams = \App\Models\Exam::whereIn('id', data_get($study, 'data.approved'))->get();
        $columns = [];
    @endphp
    <thead>
    <tr>
        <th colspan="{{ $totalColumns }}" style="border: 1px solid black;">{{ data_get($study, 'title') }}</th>
    </tr>
    <tr>
        <th colspan="{{ $totalColumns }}" style="font-size: 13px;">{{ data_get($study, 'description') }}</th>
    </tr>
    <tr></tr>
    <tr>
        <th>Identificação do Utilizador</th>
        <th>Idade</th>
        <th>Sexo</th>
        <th>Distrito</th>
        @php
            $examsTypes = \App\Models\ExamType::whereIn('id', \App\Models\Exam::whereIn('id', data_get($study, 'data.pending'))->pluck('exams_types_id')->unique()->toArray())->get();
        @endphp
        @foreach($examsTypes as $type)
            <th>{{data_get($type, 'title')}}</th>
            @php
                $params = data_get($type, 'parameters', []);
            @endphp 
            @if(data_get($params, 'type') === 'select')
                <th>Resposta</th>
                @php
                    array_push($columns, data_get($type, 'title'));
                    array_push($columns, 'respostas');
                @endphp
            @elseif(data_get($params, 'type') === 'number' && !empty($options = data_get($params, 'options', [])))
                @php
                    array_push($columns, data_get($type, 'title'));
                @endphp
                @foreach($options as $value)
                    @php
                        array_push($columns, $value);
                    @endphp
                    <th>{{$value}}</th>
                @endforeach

            @else
                <th>Resposta</th>
                @php
                    array_push($columns, data_get($type, 'title'));
                    array_push($columns, 'respostas');
                @endphp
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($exams as $exam)
        <tr>
            @php
                $user = \App\Models\User::find(data_get($exam, 'user_id'));
                $age = data_get($user, 'parameters.age', '-');
                $gender = data_get($user, 'parameters.sex', '-');
                if($gender === 'male'){
                    $gender = 'Masculino';
                }elseif ($gender === 'female'){
                    $gender = 'Feminino';
                }elseif($gender === 'other'){
                    $gender = 'Outro';
                }
                $local = data_get($user, 'parameters.local', '-');
                $params = data_get($exam, 'parameters', []);
                $resposta = data_get($params, strtolower(data_get($params, 'name')));
            @endphp
            <td>{{'Utilizador_'.data_get($user, 'id')}}</td>
            <td>{{$age}}</td>
            <td>{{$gender}}</td>
            <td>{{$local}}</td>
            <td></td>
            @foreach($columns as $column)
                @if($column === data_get($params, 'name'))
                    @if(is_object($resposta) || is_array($resposta))
                        @foreach($resposta as $value)
                            <td>{{$value}}</td>
                        @endforeach
                    @else
                        @php
                            $examType = \App\Models\ExamType::find(data_get($exam, 'exams_types_id'));
                            $paramsType = data_get($examType, 'parameters');
                        @endphp
                        @if(data_get($paramsType, 'type') === 'select')
                            <td>{{data_get($paramsType, 'options.'.$resposta)}}</td>
                        @else
                            <td>{{$resposta}}</td>
                        @endif
                    @endif
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
