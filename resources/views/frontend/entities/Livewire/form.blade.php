<div>
    <div class="container-fluid mt-5">
        <div class="container">
            <div class="section-header">
                <h2>Criar estudo</h2>
                <p>Aqui pode criar os seus estudos para posteriormente extrair os dados.</p>
            </div>
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
                    <x-form-select name="dataType"
                                   :placeholder="'Tipo de dados'"
                                   :options="$examsTypeOptions"
                                   icon="chevron-down"
                                   wire:model.lazy="filters.exam_type_id"
                    />
                </div>
                <div class="col">
                    <x-form-select name="age"
                                   :placeholder="'Faixa etária'"
                                   :options="['young' => '0-19', 'adult' => '20-59', 'old' => '>60']"
                                   icon="chevron-down"
                                   wire:model.lazy="filters.age"
                    />
                </div>
                <div class="col">
                    <x-form-select name="sexo"
                                   :placeholder="'Sexo'"
                                   :options="['male' => 'Masculino', 'female' => 'Feminino', 'other' => 'Outro']"
                                   icon="chevron-down"
                                   wire:model.lazy="filters.sex"
                    />
                </div>
            </div>
            <h5 class="text-center mt-5 mb-2">Resultados</h5>
            <table class="table">
                <thead>
                <tr>
                    {{--                    <th scope="col"></th>--}}
                    <th scope="col">Tipo de dado</th>
                    <th scope="col">Idade (anos)</th>
                    <th scope="col">sexo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allExams ?? [] as $exam)
                    @php
                        $sexText = '-';
                        $sexCode = data_get($exam->examOwner(), 'parameters.sex');
                            if($sexCode == 'male')
                                $sexText = 'Masculino';
                            if($sexCode == 'female')
                                $sexText = 'Feminino';
                            if($sexCode == 'other')
                                $sexText = 'Outro';
                    @endphp
                    <tr>
                        <td>{{data_get($exam->examType()->first(), 'title', '-')}}</td>
                        <td>{{data_get($exam->examOwner(), 'parameters.age', '-')}}</td>
                        <td>{{$sexText}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center btn-form mt-5">
                <button wire:click="storeStudy">
                    <span>Guardar</span>
                </button>
            </div>
        </div>
    </div>
</div>
