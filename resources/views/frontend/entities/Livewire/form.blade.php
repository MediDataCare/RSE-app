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
                                 :placeholder="'Descrição'" class="form-control mb-3"
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
            <h4 class="text-center py-1"><b>Filtros</b></h4>
            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 gy-3 pb-5 justify-content-center">
                <div class="col">
                    <b><label>{{'Dados'}}</label></b>
                    <select class="exams-multiple w-100" name="exams[]" multiple="multiple" wire:model="filters.exams"
                            data-placeholder="Tipo de Dados">
                        @foreach($examsTypeOptions as $key => $exam)
                            <optgroup label="{{$key}}">
                                @foreach($exam as $id => $value)
                                    <option value="{{$id}}">{{$value}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                </div>
                <div class="col">
                    <b><label>{{'Faixa etária'}}</label></b>
                    <div class="row row-cols-2">
                        <div class="col">
                            <x-form-input name="age_min" :placeholder="'Idade Miníma'" class="form-control mb-3"
                                          wire:model.lazy="filters.age_min" type="number"/>
                        </div>
                        <div class="col">
                            <x-form-input name="age_max" :placeholder="'Idade Máxima'" class="form-control mb-3"
                                          wire:model.lazy="filters.age_max" type="number"/>
                        </div>
                    </div>

                </div>
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
            <h4 class="text-center mt-2 mb-3"><b>Resultados</b></h4>
            <!-- Esta alnhado ao Centro, mas ha bug na pagina e parece mal.....
            <div class="chart-container" style="display: flex; justify-content: center; align-items: center; height: 40vh; width: 80vw;">
                <canvas id="myChart"></canvas>
            </div> -->
            <div class="chart-container" style="position: relative; height:25vh; width:25vw">
                <canvas id="myChart"></canvas>
            </div>
            <h5 class="mt-5 mb-2">{{ $allExams->count() . '/' . $allExamsOriginal->count() . ' Resultados
                encontrados'}}</h5>

            <script>
                const examsCount = {{ $allExams->count() }};
                const originalCount = {{ $allExamsOriginal->count() }};

                const data = {
                    labels: ['Exams', 'Remaining'],
                    datasets: [{
                        data: [examsCount, originalCount - examsCount],
                        backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)'],
                        hoverOffset: 4,
                    }],
                };

                const config = {
                    type: 'doughnut',
                    data: data,
                };

                const ctx = document.getElementById('myChart').getContext('2d');

                const myChart = new Chart(ctx, config);
            </script>


            <div class="text-center btn-form mt-5">
                <button wire:click="{{$action === 'create' ? "storeStudy" : "updateStudy"}}">
                    <span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
    <script type="module">
        document.addEventListener("DOMContentLoaded", () => {
            $('.exams-multiple').select2({
                placeholder: function () {
                    $(this).data('placeholder');
                }
            });
            $('.sex-multiple').select2({
                placeholder: function () {
                    return $(this).data('placeholder');
                }
            });

            $('.exams-multiple').on('change', function (e) {
                var data = $('.exams-multiple').select2("val");
                @this.
                set('filters.exams', data);
            });

            $('.sex-multiple').on('change', function (e) {
                var data = $('.sex-multiple').select2("val");
                @this.
                set('filters.sex', data);
            });


            Livewire.hook('component.initialized', (component) => {
                $('.exams-multiple').select2();
                $('.exams-multiple').on('change', function (e) {
                    var data = $('.exams-multiple').select2("val");
                    @this.
                    set('filters.exams', data);
                });

                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.
                    set('filters.sex', data);
                });
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.exams-multiple').select2();
                $('.exams-multiple').on('change', function (e) {
                    var data = $('.exams-multiple').select2("val");
                    @this.
                    set('filters.exams', data);
                });

                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.
                    set('filters.sex', data);
                });

            })
        });
    </script>
</div>
