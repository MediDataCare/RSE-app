<div>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="section-header">
                <h2>Criar Formulário</h2>
                <p>Aqui pode criar os formulários para os utilizadores inserirem os seus dados.</p>
            </div>
            <x-form-input action="create"
                          name="title"
                          :label="'Titulo'"
                          :placeholder="'Titulo'"
                          class="form-control mb-3"
                          wire:model="title"
            />

            <div class="{{$addGroup ? 'd-none' : 'd-block'}}">
                <div class="row">
                    <div class="col-11">
                        <x-form-select action="create"
                                       name="group"
                                       :label="'Grupo'"
                                       :placeholder="'Grupos'"
                                       :options="$allExamsParams"
                                       icon="chevron-down"
                                       wire:model="group"
                        />
                    </div>
                    <div class="col-1 border border-0 bg-white">
                        <a wire:click="addGroup">
                            <i class="fas fa-plus-circle" style="margin-top: 36px;"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="{{$addGroup ? 'd-block' : 'd-none'}}">
                <x-form-input action="create"
                              name="group"
                              :label="'Grupo'"
                              :placeholder="'Grupo'"
                              :class="'form-control mb-3'"
                              wire:model="group"
                />
            </div>

            <x-form-select action="create"
                           name="inputs.type"
                           :label="'Tipo de dados'"
                           :placeholder="'Tipo de dados'"
                           :options="['select' => 'Várias opções', 'number' => 'Número', 'text' => 'Texto']"
                           icon="chevron-down"
                           wire:model="inputs.type"
            />

            @if(data_get($inputs, 'type') === 'select')
                <h5>Adicionar opções</h5>
                <div class="p-4">
                    @foreach(data_get($inputs, 'options.options') ?? [] as $opt => $option)
                        @php
                            $optName = 'opt-'.$opt;
                        @endphp
                        <x-form-input action="create"
                                      name="inputs.options.options.{{$opt}}"
                                      :label="'Opção'"
                                      :placeholder="'Opção'"
                                      :class="'form-control mb-3'"
                                      wire:model.lazy="inputs.options.options.{{$opt}}"
                        />
                    @endforeach
                    <div class="w-100 text-center btn-form mt-5">
                        <button wire:click="addOptions">
                            {{ 'Adicionar novos dados' }}
                        </button>
                    </div>
                </div>
            @elseif(data_get($inputs, 'type') === 'number')
                <x-form-input action="create"
                              type="number"
                              name="inputs.options.min-number"
                              :label="'Valor minimo'"
                              :placeholder="'Valor minimo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.min-number"
                />
                <x-form-input action="create"
                              type="number"
                              name="inputs.options.max-number"
                              :label="'Valor máximo'"
                              :placeholder="'Valor máximo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.max-number"
                />
                <x-form-input action="create"
                              name="inputs.options.unit"
                              :label="'Unidade'"
                              :placeholder="'Unidade'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.unit"
                />
            @endif

            <div class="row row-cols-1 row-cols-sm-2">
                <div class="col">
                    <div class="w-100 text-center btn-form mt-5">
                        <a href="{{route('exam-type-index')}}">
                            {{ 'Cancel' }}
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="w-100 text-center btn-form mt-5">
                        <button wire:click="storeData">
                            {{ 'Guardar' }}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
