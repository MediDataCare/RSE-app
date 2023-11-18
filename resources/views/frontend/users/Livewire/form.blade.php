<div>
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="section-header">
                <h2>Inserir Dados</h2>
                <p>Aqui pode introduzir as suas informações e dados médicos para posteriormente receber recompensas monetárias pela
                    partilha dos mesmos</p>
            </div>
            <div class="mb-3">
                {{--                <x-form-select name="selectExamType"--}}
                {{--                               :placeholder="'Tipo de dados'"--}}
                {{--                               :options="$examsTypeOptions"--}}
                {{--                               icon="chevron-down"--}}
                {{--                               wire:model="selectExamType"--}}
                {{--                />--}}
                <select class="js-example-basic-multiple w-100" name="exams[]" multiple="multiple"
                        wire:model="selectExamType">
                    @foreach($examsTypeOptions as $key => $exam)
                        <optgroup label="{{$key}}">
                            @foreach($exam as $id => $value)
                                <option value="{{$id}}">{{$value}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
            @if($showForm)
                <h4>Descrição</h4>
                <p class="mb-5">{{data_get($examsType, 'description', 'Sem informação')}}</p>
                @foreach($examsType ?? [] as $examType)
                    @php
                        $value = data_get($examType, 'parameters');
                    @endphp
                    @if(data_get($value, 'type') === 'text')
                        <div class="mb-3">
                            <x-form-input action="create"
                                          name="{{Str::slug(data_get($examType, 'title'))}}"
                                          :label="data_get($examType, 'title')"
                                          :placeholder="data_get($examType, 'title')"
                                          class="form-control mb-2"
                                          wire:model.lazy="inputs.{{Str::slug(data_get($examType, 'id'))}}"
                            />
                        </div>
                    @elseif(data_get($value, 'type') === 'select')
                        <div class="mb-3">
                            <x-form-select name="{{Str::slug(data_get($examType, 'title'))}}"
                                           :placeholder="data_get($examType, 'title')"
                                           :label="data_get($examType, 'title')"
                                           :options="data_get($value, 'options', [])"
                                           icon="chevron-down"
                                           wire:model.lazy="inputs.{{Str::slug(data_get($examType, 'id'))}}"
                            />
                        </div>
                    @elseif(data_get($value, 'type') === 'number')
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-11">
                                    <x-form-input action="create"
                                                  name="{{Str::slug(data_get($examType, 'title'))}}"
                                                  type="number"
                                                  step="0.01"
                                                  :label="data_get($examType, 'title')"
                                                  :placeholder="data_get($examType, 'title')"
                                                  class="form-control mb-2"
                                                  wire:model.lazy="inputs.{{Str::slug(data_get($examType, 'id'))}}"
                                    />
                                </div>
                                <div class="col-1">
                                    <x-form-input name="unit"
                                                  action="show"
                                                  :label="'Unidade'"
                                                  :value="data_get($value, 'unit', '-')"
                                                  :placeholder="'Unidade'"
                                                  class="form-control mb-2 form-control-plaintext border-0 text-center"
                                                  readonly
                                    />
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

            {{--                <x-form-checkbox name="agreeterms" label="Concordo com os termos"/>--}}
            <div class="text-center btn-form mt-5">
                <button wire:click="storeExam">
                    <span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="module">

    document.addEventListener("DOMContentLoaded", () => {
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiple').on('change', function (e) {
            console.log('entrei')
            var data = $('.js-example-basic-multiple').select2("val");
            @this.set('selectExamType', data);
        });
        Livewire.hook('component.initialized', (component) => {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-multiple').on('change', function (e) {
                var data = $('.js-example-basic-multiple').select2("val");
                @this.set('selectExamType', data);
            });
        })
        Livewire.hook('message.processed', (message, component) => {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-multiple').on('change', function (e) {
                var data = $('.js-example-basic-multiple').select2("val");
                @this.set('selectExamType', data);
            });
        })
    });
</script>
