<div>
    <div class="container-fluid mt-5">
        <div class="container">
            @if($action === 'create')
                <div class="section-header">
                    <h2>Criação Dado</h2>
                    <p>Aqui pode criar um dado.</p>
                </div>
            @elseif($action === 'edit')
                <div class="section-header">
                    <h2>Editar Dado</h2>
                    <p>Aqui pode editar o dado.</p>
                </div>
            @else
                <div class="section-header">
                    <h2>Mostrar Dado</h2>
                    <p>Aqui pode visualizar o dado.</p>
                </div>
            @endif
            @if($action === 'show')
                <div class="btn-form mb-3">
                    <a href="{{route('exam-type-edit', ['id' => $examType->id])}}">
                        {{'Editar formulário'}}
                    </a>
                </div>
            @endif
            <x-form-input action="{{$action}}"
                          name="title"
                          :label="'Titulo'"
                          :placeholder="'Titulo'"
                          class="form-control mb-3"
                          wire:model="title"
            />

            <div class="{{$addGroup ? 'd-none' : 'd-block'}}">
                <div class="row">
                    <div class="col-11">
                        <x-form-select action="{{$action}}"
                                       name="group"
                                       :label="'Grupo'"
                                       :placeholder="'Grupos'"
                                       :value="$group"
                                       :options="$allExamsParams"
                                       icon="chevron-down"
                                       wire:model="group"
                        />
                    </div>
                    @if($action !== 'show')
                        <div class="col-1 border border-0 bg-white">
                            <a wire:click="addGroup">
                                <i class="fas fa-plus-circle" style="margin-top: 36px;"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="{{$addGroup ? 'd-block' : 'd-none'}}">
                <x-form-input action="{{$action}}"
                              name="group"
                              :label="'Grupo'"
                              :placeholder="'Grupo'"
                              :class="'form-control mb-3'"
                              wire:model="group"
                />
            </div>
            <x-form-select action="{{$action}}"
                           name="inputs.type"
                           :label="'Tipo de dados'"
                           :value="data_get($inputs, 'type')"
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
                        @if($action !== 'show')
                            <button class="btn btm-white float-end" wire:click="removeInput({{ $opt }})">Remover dados
                            </button>
                        @endif
                        <x-form-input action="{{$action}}"
                                      name="inputs.options.options.{{$opt}}"
                                      :label="'Opção ' . $opt + 1"
                                      :placeholder="'Opção ' . $opt + 1"
                                      :class="'form-control mb-3'"
                                      wire:model.lazy="inputs.options.options.{{$opt}}"
                        />
                    @endforeach
                    @if($action !== 'show')
                        <div class="w-100 text-center btn-form mt-5">
                            <button wire:click="addOptions">
                                {{ 'Adicionar novos dados' }}
                            </button>
                        </div>
                    @endif
                </div>
            @elseif(data_get($inputs, 'type') === 'number')
                <x-form-input action="{{$action}}"
                              type="number"
                              name="inputs.options.min-number"
                              :label="'Valor minimo'"
                              :placeholder="'Valor minimo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.min-number"
                />
                <x-form-input action="{{$action}}"
                              type="number"
                              name="inputs.options.max-number"
                              :label="'Valor máximo'"
                              :placeholder="'Valor máximo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.max-number"
                />
                <x-form-input action="{{$action}}"
                              name="inputs.options.unit"
                              :label="'Unidade'"
                              :placeholder="'Unidade'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.unit"
                />
            @endif

            @if($action !== 'show')
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
                            @if($action === 'create')
                                <button wire:click="storeData">
                                    {{ 'Guardar' }}
                                </button>
                            @elseif($action === 'edit')
                                <button wire:click="updateData">
                                    {{ 'Guardar' }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
