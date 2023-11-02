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

            <x-form-textarea
                action="create"
                name="description"
                :label="'Descrição'"
                :placeholder="'Descrição'"
                class="form-control mb-3"
                wire:model="description"
            />

            <h5 class="text-center mt-5 mb-3">Dados</h5>

        @foreach ($inputs ?? [] as $key => $input)
                <div class="card mb-4">
                    <div class="card-header">
                        <button class="btn btm-white float-end" wire:click="removeInput({{ $key }})">Remover dados
                        </button>

                    </div>
                    <div class="card-body">
                        <x-form-input action="create"
                                      name="inputs.{{ $key }}.title"
                                      :label="'Titulo'"
                                      :placeholder="'Titulo'"
                                      :class="'form-control mb-3'"
                                      wire:model.lazy="inputs.{{ $key }}.title"
                        />
                        <x-form-select action="create"
                                       name="inputs.{{ $key }}.type"
                                       :label="'Tipo de dados'"
                                       :placeholder="'Tipo de dados'"
                                       :options="['select' => 'Várias opções', 'number' => 'Número', 'text' => 'Texto']"
                                       icon="chevron-down"
                                       wire:model="inputs.{{ $key }}.type"
                        />
                        @if(data_get($inputs, $key . '.type') === 'select')
                            @php

                            @endphp
                            <h5 class="mt-5">Opções</h5>
                        @foreach(data_get($inputs, $key . '.options') as $opt => $option)
                                <x-form-input action="create"
                                              name="inputs.{{ $key }}.options.{{$opt}}"
                                              :label="'Titulo'"
                                              :placeholder="'Titulo'"
                                              :class="'form-control mb-3'"
                                              wire:model.lazy="inputs.{{ $key }}.options.{{$opt}}"
                                />
                        @endforeach
                            <div class="w-100 text-center btn-form mt-5">
                                <button wire:click="addOptions('{{ $key }}')">
                                    {{ 'Adicionar novas opções' }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <div class="w-100 text-center btn-form mt-5">
                <button wire:click="addInput">
                    {{ 'Adicionar novos dados' }}
                </button>
            </div>

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
