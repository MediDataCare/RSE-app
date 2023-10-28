@extends('theme.master')
@section('content') 
<div>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <div class="container-fluid mt-5">
        <div class="container">
            <h5 class="text-center">Registo de dados</h5>
            <x-form class="row mt-5 pb-5" method="POST">
                <div class="mb-3">
                    <x-form-select name="dataType"
                                    :placeholder="'Tipo de dados'"
                                    :options="['data1' => 'Raio X', 'data2' => 'Análises Clínicas', 'data3' => 'Ecografia']"
                                    icon="chevron-down"
                    />
                </div>
                <div class="mb-3">
                    <x-form-input action="create"
                                name="etaria"
                                type="number"
                                :label="'Faixa etária'"
                                :placeholder="'Faixa etária'"
                                class="'form-control mb-2'"
                    />
                </div>

                <div class="mb-3">
                    <x-form-select name="distrito"
                                   :placeholder="'Distrito'"
                                   :options="['data1' => 'distrito 1', 'data2' => 'distrito 2', 'data3' => 'distrito 3']"
                                   icon="chevron-down"
                    />
                </div>

                <div class="mb-3">
                    <x-form-select name="sexo"
                                   :placeholder="'Sexo'"
                                   :options="['data1' => 'sexo 1', 'data2' => 'sexo 2', 'data3' => 'sexo 3']"
                                   icon="chevron-down"
                    />
                </div>

                <div class="mb-3">
                    <x-form-select name="historial"
                                   :placeholder="'Historial médico'"
                                   :options="['data1' => 'Tipo de dados 1', 'data2' => 'Tipo de dados 2', 'data3' => 'Tipo de dados 3']"
                                   icon="chevron-down"
                    />
                </div>

                <div class="mb-3">
                    <x-form-select name="avc"
                                   :placeholder="'AVC'"
                                   :options="['data1' => 'Sim', 'data2' => 'Não']"
                                   icon="chevron-down"
                    />
                </div>

                <div class="mb-5">
                    <x-form-select name="diabetes"
                                   :placeholder="'Diabetes'"
                                   :options="['data1' => 'Sim', 'data2' => 'Não']"
                                   icon="chevron-down"
                    />
                </div>

                <x-form-checkbox name="agreeterms" label="Concordo com os termos" />

                    <x-form-submit>
                        <span>Guardar</span>
                    </x-form-submit>
            </x-form>
        </div>
    </div>
</div>
@stop