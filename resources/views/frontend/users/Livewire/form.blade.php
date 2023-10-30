<div>
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="section-header">
                <h2>Registo de dados</h2>
                <p>Aqui pode registar os seus dados médicos para posteriormente receber recompensas monetárias pela venda dos mesmos.</p>
            </div>
            <div class="mb-3">
                <x-form-select name="selectExamType"
                               :placeholder="'Tipo de dados'"
                               :options="$examsTypeOptions"
                               icon="chevron-down"
                               wire:model="selectExamType"
                />
            </div>

            @if($showForm)
                @foreach(data_get($examsType, 'parameters') ?? [] as $key => $value)
                    @if(data_get($value, 'type') === 'text')
                        <div class="mb-3">
                            <x-form-input action="create"
                                          name="{{Str::slug(data_get($value, 'title'))}}"
                                          :label="data_get($value, 'title')"
                                          :placeholder="data_get($value, 'title')"
                                          class="form-control mb-2"
                                          wire:model.lazy="inputs.{{ $key }}.{{Str::slug(data_get($value, 'title'))}}"
                            />
                        </div>
                    @elseif(data_get($value, 'type') === 'select')
                        <div class="mb-3">
                            <x-form-select name="{{Str::slug(data_get($value, 'title'))}}"
                                           :placeholder="data_get($value, 'title')"
                                           :label="data_get($value, 'title')"
                                           :options="data_get($value, 'options', [])"
                                           icon="chevron-down"
                                           wire:model.lazy="inputs.{{ $key }}.{{Str::slug(data_get($value, 'title'))}}"
                            />
                        </div>
                    @elseif(data_get($value, 'type') === 'number')
                        <div class="mb-3">
                            <x-form-input action="create"
                                          name="{{Str::slug(data_get($value, 'title'))}}"
                                          type="number"
                                          :label="data_get($value, 'title')"
                                          :placeholder="data_get($value, 'title')"
                                          class="form-control mb-2"
                                          wire:model.lazy="inputs.{{ $key }}.{{Str::slug(data_get($value, 'title'))}}"
                            />
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
