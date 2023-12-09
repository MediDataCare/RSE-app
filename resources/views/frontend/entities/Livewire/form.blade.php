<div>
    <div class="container-fluid my-5">
        <div class="container">
            <div class="section-header">
                @if($action === 'create')
                    <h2>Criar Estudo</h2>
                    <p>Aqui pode criar novos estudos para posteriormente extrair os dados partilhados pelos
                        utilizadores</p>
                @else
                    <h2>Editar Estudo</h2>
                    <p>Aqui pode editar o estudo para posteriormente extrair os dados partilhados pelos utilizadores</p>
                @endif
            </div>
            <b>
                <x-form-input action="create" name="title" :label="'Título'" :placeholder="'Introduza o Título'"
                              class="form-control mb-3" wire:model.lazy="inputs.title" required/>
            </b>

            <b>
                <x-form-textarea action="create" name="description" :label="'Introduza a Descrição'"
                                 :placeholder="'Introduza a Descrição'" class="form-control mb-3"
                                 wire:model.lazy="inputs.description"/>
            </b>

            <b>
                <x-form-input action="create" name="expected_Exams" type="number" :label="'Dados esperados'"
                              :placeholder="'Introduza o nº mínimo de Dados esperados'" class="form-control mb-3"
                              wire:model.lazy="inputs.expected_Exams"/>
            </b>

            <b>
                <x-form-input action="create" name="duration" type="number" :label="'Duração (dias)'"
                              :placeholder="'Introduza a Duração em Dias'" class="form-control"
                              wire:model.lazy="inputs.duration"/>
            </b>
            <h4 class="text-center py-1 mt-5"><b>Filtros</b></h4>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 gy-3 pb-5 justify-content-center">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <b><label class="text-center w-100">{{'Dados'}}</label></b>
                        </div>
                        <div class="col-12">
                            <div class="row row-cols-2">
                                <div class="col-5">
                                    <!-- Button trigger modal -->
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#exampleModal">
                                        <i class="fas fa-plus-circle"></i><span>Adicionar filtro</span>
                                    </a>
                                </div>
                                <div class="col-7">
                                    @if(!empty($filters))
                                        <h5 class="fw-bold">Filtros Selecionados</h5>
                                    @endif
                                    @foreach($filters as $value)
                                        @if(data_get($value, 'exams.id'))
                                            @php
                                                $examType = \App\Models\ExamType::find(data_get($value, 'exams.id'));
                                            @endphp
                                            <p>{{data_get($examType, 'title')}}<i class="fa fa-times ms-2 text-danger"
                                                                                  aria-hidden="true"
                                                                                  wire:click="removeFromFilter('{{ data_get($value, 'exams.id') }}')"></i>
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
{{--                <div class="col">--}}
{{--                    <b><label>{{'Faixa etária'}}</label></b>--}}
{{--                    <div class="row row-cols-2">--}}
{{--                        <div class="col">--}}
{{--                            <x-form-input name="age_min[]" :placeholder="'Idade Miníma'" class="form-control mb-3"--}}
{{--                                          wire:model.lazy="filters.age_min" type="number"/>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <x-form-input name="age_max[]" :placeholder="'Idade Máxima'" class="form-control mb-3"--}}
{{--                                          wire:model.lazy="filters.age_max" type="number"/>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
                <div class="col">
                    <b><label>{{'Sexo'}}</label></b>
                    <select class="sex-multiple w-100" name="sexo[]" multiple="multiple" wire:model="filters.sex"
                            data-placeholder="Selecione o Sexo">
                        @foreach($gender ?? [] as $key => $sex)
                            <option value="{{$key}}">{{$sex}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar filtro</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="w-100 form-control" id="examType" name="exams[]"
                                    data-placeholder="Tipo de Dados">
                                @foreach($examsTypeOptions as $key => $exam)
                                    <option value="default">{{'Dado'}}</option>
                                    <optgroup label="{{$key}}">
                                        @foreach($exam as $id => $value)
                                            <option value="{{$id}}">{{$value}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @php
                                $examType = \App\Models\ExamType::find($selectExam);
                            @endphp
                            @if(!empty($examType))
                                <h3 class="my-3">{{data_get($examType, 'title')}}</h3>

                                @if(data_get($examType, 'parameters.type') === 'select')
                                    <select class="w-100 form-control" id="examOptions" name="options[]">
                                        <option value="default">{{'Opção'}}</option>
                                        @foreach(data_get($examType, 'parameters.options') ?? [] as $key => $exam)
                                            <option value="{{data_get($examType, 'title').'-'.$key}}">{{$exam}}</option>
                                        @endforeach
                                    </select>
                                @elseif(data_get($examType, 'parameters.type') === 'number' && !empty(data_get($examType, 'parameters.options') ))
                                    @foreach(data_get($examType, 'parameters.options') ?? [] as $key => $exam)
                                        <p>{{$exam}}</p>
                                        <x-form-input name="{{$exam.'_min'}}" id="min" :placeholder="'Minimo'"
                                                      class="form-control mb-3"
                                                      type="number"/>
                                        <x-form-input name="{{$exam.'_max'}}" id="max" :placeholder="'Máximo'"
                                                      class="form-control mb-3"
                                                      type="number"/>
                                    @endforeach
                                @elseif(data_get($examType, 'parameters.type') === 'number' && empty(data_get($examType, 'parameters.options') ))
                                    <p>{{ data_get($examType, 'title') }}</p>
                                    <x-form-input name="{{ strtolower(data_get($examType, 'title').'_min') }}" id="min"
                                                  :placeholder="'Minimo'" class="form-control mb-3"
                                                  type="number"/>
                                    <x-form-input name="{{ strtolower(data_get($examType, 'title').'_max') }}" id="max"
                                                  :placeholder="'Máximo'" class="form-control mb-3"
                                                  type="number"/>
                                @endif
                            @endif
                            {{--                                                        @dump($examType)--}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    wire:click="saveFilter()">Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="text-center mt-2 mb-3"><b>Resultados Encontrados</b></h4>
            <h5 class="fw-bold mt-5 mb-2 text-center fs-3">
                <span
                    class="text-success">{{ $allExams->count() }}</span><span> / {{ $allExamsOriginal->count() }}</span>
            </h5>

            <div class="text-center btn-form mt-5">
                <button wire:click="{{$action === 'create' ? "storeStudy" : "updateStudy"}}">
                    <span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
    <script type="module">

        var mySelect = document.getElementById('examType');
        if (mySelect != null) {

            mySelect.onchange = (event) => {
                var inputText = event.target.value;
                @this.
                set('selectExam', inputText);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {

            // $('.exams-multiple').select2({
            //     placeholder: function () {
            //         $(this).data('placeholder');
            //     }
            // });
            $('.sex-multiple').select2({
                placeholder: function () {
                    return $(this).data('placeholder');
                }
            });
            console.log(@json($examType));
            {{--$('.exams-multiple').on('change', function (e) {--}}
            {{--    var data = $('.exams-multiple').select2("val");--}}
            {{--    @this.--}}
            {{--    set('filters.exams', data);--}}
            {{--});--}}

            $('.sex-multiple').on('change', function (e) {
                var data = $('.sex-multiple').select2("val");
                @this.
                set('filters.sex', data);
            });


            Livewire.hook('component.initialized', (component) => {
                {{--$('.exams-multiple').select2();--}}
                {{--$('.exams-multiple').on('change', function (e) {--}}
                {{--    var data = $('.exams-multiple').select2("val");--}}
                {{--    @this.--}}
                {{--    set('filters.exams', data);--}}
                {{--});--}}

                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.
                    set('filters.sex', data);
                });
            })

            Livewire.hook('message.processed', (message, component) => {
                var myOption = document.getElementById('examOptions');
                if (myOption != null) {
                    myOption.onchange = (event) => {
                        var inputOption = event.target.value;
                        @this.
                        set('selectOption', inputOption);
                    }
                }

                {{--var myNumber = document.getElementById('number-input');--}}
                {{--if (myNumber != null) {--}}
                {{--    myNumber.onchange = (event) => {--}}
                {{--        var inputOption = event.target.value;--}}
                {{--        @this.--}}
                {{--        set('selectMinMax', inputOption);--}}
                {{--    }--}}
                {{--}--}}


                const minInputs = document.querySelectorAll('input[name$="_min"]');
                const maxInputs = document.querySelectorAll('input[name$="_max"]');


                minInputs.forEach(function (min) {
                    @this.
                    set('selectMinMax.' + min.name, min.value);
                });
                maxInputs.forEach(function (max) {
                    @this.
                    set('selectMinMax.' + max.name, max.value);
                });


                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.
                    set('filters.sex', data);
                });

            })
        });

        // window.addEventListener('closeModal', event => {
        //     $('#exampleModal').modal('hide');
        //     // $('body').removeClass('modal-open');
        //     $('.modal-backdrop').remove();
        // });

    </script>
</div>
