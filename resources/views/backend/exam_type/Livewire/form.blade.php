<div>
    <div class="container-fluid mt-5">
        <div class="container">
            @if($action === 'create')
                <div class="section-header">
                    <h2>Adicionar novo Tipo de Dados</h2>
                    <p>Configure o Tipo de Dados que pretende adicionar à Plataforma, certifique-se de preencher o Título e o seu tipo de dados
                        <br>Pode ser editado mais tarde...</p>
                </div>
            @elseif($action === 'edit')
                <div class="section-header">
                    <h2>Editar Dado</h2>
                    <p>Pode alterar ou adicionar características para este Dado</p>
                </div>
            @else
                <div class="section-header">
                    <h2>Características do Dado</h2>
                    <p>Pode observar e validar os parâmetros definidos para este Dado</p>
                </div>
            @endif
            @if($action === 'show')
                <div class="row mb-3">
                    <div class="col-6 d-flex align-items-center ">
                        <a href="{{ route('exam-type-index') }}">
                            <i class="fas fa-arrow-left fs-4"></i>
                        </a>
                    </div>
                    <div class="col-6 text-end btn-form">
                        <button onclick="window.location.href='{{ route('exam-type-edit', ['id' => $examType->id]) }}'">
                            {{ 'Editar Dado' }}
                        </button>
                    </div>
                </div>
            @endif
            <b><x-form-input action="{{$action}}"
                          name="title"
                          :label="'Título'"
                          :placeholder="'Introduza o Título'"
                          class="form-control mb-3"
                          wire:model="title"
            /></b>

            <div class="{{$addGroup ? 'd-none' : 'd-block'}}">
                <div class="row">
                    <div class="{{$action ==='show' ? 'col-12' : 'col-11'}}">
                        <b><x-form-select action="{{$action}}"
                                       name="group"
                                       :label="'Grupo'"
                                       :placeholder="'Grupos'"
                                       :value="$group"
                                       :options="$allExamsParams"
                                       :class="'mb-3'"
                                       icon="chevron-down"
                                       wire:model="group"
                        /></b>
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
                <b><x-form-input action="{{$action}}"
                              name="group"
                              :label="'Grupo'"
                              :placeholder="'Introduza o novo Grupo'"
                              :class="'form-control mb-3'"
                              wire:model="group"
                /></b>
            </div>
            <b><x-form-select action="{{$action}}"
                           name="inputs.type"
                           :label="'Tipo de Dados'"
                           :value="data_get($inputs, 'type')"
                           :placeholder="'Selecione o Tipo de dados'"
                           :options="['select' => 'Várias opções', 'number' => 'Número', 'text' => 'Texto']"
                           :class="'mb-3'"
                           icon="chevron-down"
                           wire:model="inputs.type"
            /></b>
            @if(data_get($inputs, 'type') === 'select')
                <b><p class="mt-3">Adicionar Opções</p></b>
                <div class="p-2">
                    @foreach(data_get($inputs, 'options.options') ?? [] as $opt => $option)
                        @php
                            $optName = 'opt-'.$opt;
                        @endphp
                        @if($action !== 'show')
                            <button class="btn btm-white float-end remove_dados" wire:click="removeInput({{ $opt }})"><i class="fas fa-minus"></i> Remover
                            </button>
                        @endif
                        <b><x-form-input action="{{$action}}"
                                      name="inputs.options.options.{{$opt}}"
                                      :label="'Opção ' . $opt + 1"
                                      :placeholder="'Introduza a Opção ' . $opt + 1"
                                      :class="'form-control mb-3'"
                                      wire:model.lazy="inputs.options.options.{{$opt}}"
                        /></b>
                    @endforeach
                    @if($action !== 'show')
                        <div class="w-100 text-center mt-1">
                            <div class=" text-center" class="add_dados" >
                                <p class="add_dados" wire:click="addOptions">
                                    <i class="fas fa-plus"></i>
                                    {{ 'Adicionar Opção' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            @elseif(data_get($inputs, 'type') === 'number')
                <b><x-form-input action="{{$action}}"
                              type="number"
                              name="inputs.options.min-number"
                              :label="'Valor mínimo'"
                              :placeholder="'Introduza o valor minimo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.min-number"
                /></b>
                <b><x-form-input action="{{$action}}"
                              type="number"
                              name="inputs.options.max-number"
                              :label="'Valor máximo'"
                              :placeholder="'Introduza o valor máximo'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.max-number"
                /></b>
                <b><x-form-input action="{{$action}}"
                              name="inputs.options.unit"
                              :label="'Unidade'"
                              :placeholder="'Defina a Unidade'"
                              :class="'form-control mb-3'"
                              wire:model.lazy="inputs.options.unit"
                /></b>
            @endif

            @if($action !== 'show')
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="col">
                        <div class="w-100 text-center btn-form mt-5">
                            <!-- Alterei para Botao apenas pelo Layout, podemos dar rollback -->
                            <button onclick="window.location='{{ route('exam-type-index') }}'">
                                {{ 'Cancelar' }}
                            </button>
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
