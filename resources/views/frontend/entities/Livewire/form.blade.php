<div>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="section-header">
                <h2>Criar Estudo</h2>
                <p>Aqui pode criar novos estudos para posteriormente extrair os dados partilhados pelos utilizadores</p>
            </div>
            @dump($filters)
            <x-form class="pb-5" method="POST">
                <x-form-input action="create"
                              name="title"
                              :label="'Title'"
                              :placeholder="'Titulo'"
                              class="form-control mb-3"
                              wire:model.lazy="inputs.title"
                              required
                />

                <x-form-textarea
                    action="create"
                    name="description"
                    :label="'Descrição'"
                    :placeholder="'Descrição'"
                    class="form-control mb-3"
                    wire:model.lazy="inputs.description"
                />

                <x-form-input action="create"
                              name="expected_Exams"
                              type="number"
                              :label="'Dados minimos esperados'"
                              :placeholder="'Dados minimos esperados'"
                              class="form-control mb-2"
                              wire:model.lazy="inputs.expected_Exams"
                />

                <x-form-input action="create"
                      name="duration"
                      type="number"
                      :label="'Duração (dias)'"
                      :placeholder="'Duração (dias)'"
                      class="form-control mb-2"
                      wire:model.lazy="inputs.duration"
                />

            </x-form>
            <h5 class="text-center py-3">Filtros</h5>
            <div class="justify-content-center row row-cols-1 row-cols-lg-3 row-cols-md-2 gy-3 pb-5">
                <div class="col">
                    <label>{{'Dados'}}</label>
                    <select class="exams-multiple w-100" name="exams[]" multiple="multiple"
                            wire:model="filters.exams" data-placeholder="Dados">
                        @foreach($examsTypeOptions as $key => $exam)
                            <optgroup label="$key">
                                @foreach($exam as $id => $value)
                                    <option value="{{$id}}">{{$value}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                </div>
                <div class="col">
                    <label>{{'Faixa etária'}}</label>
                    <div class="row row-cols-2">
                        <div class="col">
                            <x-form-input name="age_min"
                                          :placeholder="'Idade miníma'"
                                          class="form-control mb-3"
                                          wire:model.lazy="filters.age_min"
                                          type="number"
                            />
                        </div>
                        <div class="col">
                            <x-form-input name="age_max"
                                          :placeholder="'Idade máxima'"
                                          class="form-control mb-3"
                                          wire:model.lazy="filters.age_max"
                                          type="number"
                            />
                        </div>
                    </div>

                </div>
                <div class="col">
                    <label>{{'Dados'}}</label>
                    <select class="sex-multiple w-100" name="sexo[]" multiple="multiple"
                            wire:model="filters.sex" data-placeholder="Dados">
                        @foreach($gender ?? [] as $key => $sex)
                            <option value="{{$key}}">{{$sex}}</option>
                        @endforeach
                    </select>
{{--                    <x-form-select name="sexo"--}}
{{--                                   :placeholder="'Sexo'"--}}
{{--                                   :options=""--}}
{{--                                   icon="chevron-down"--}}
{{--                                   wire:model.lazy="filters.sex"--}}
{{--                    />--}}
                </div>
            </div>
            <h5 class="text-center mt-5 mb-2">Resultados</h5>
            <h5 class="text-center mt-5 mb-2">{{ $allExams->count() . '/' . $allExamsOriginal->count() . ' Resultados encontrados'}}</h5>

            <div class="text-center btn-form mt-5">
                <button wire:click="storeStudy">
                    <span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
    <script type="module">

        document.addEventListener("DOMContentLoaded", () => {
            $('.exams-multiple').select2({
                placeholder: function(){
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
                @this.set('filters.exams', data);
            });

            $('.sex-multiple').on('change', function (e) {
                var data = $('.sex-multiple').select2("val");
                @this.set('filters.sex', data);
            });


            Livewire.hook('component.initialized', (component) => {
                $('.exams-multiple').select2();
                $('.exams-multiple').on('change', function (e) {
                    var data = $('.exams-multiple').select2("val");
                    @this.set('filters.exams', data);
                });

                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.set('filters.sex', data);
                });
            })

            Livewire.hook('message.processed', (message, component) => {
                $('.exams-multiple').select2();
                $('.exams-multiple').on('change', function (e) {
                    var data = $('.exams-multiple').select2("val");
                    @this.set('filters.exams', data);
                });

                $('.sex-multiple').select2();
                $('.sex-multiple').on('change', function (e) {
                    var data = $('.sex-multiple').select2("val");
                    @this.set('filters.sex', data);
                });

            })
        });
    </script>
</div>
