<div>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <div class="container-fluid mt-5">
        <div class="container">
            <h5 class="text-center">Criar estudo</h5>
            <x-form class="mt-5 pb-5" method="POST">
                <x-form-input action="create"
                              name="name"
                              :label="'Nome'"
                              :placeholder="'Nome'"
                              class="'form-control mb-2'"
                />

                <x-form-textarea
                    action="create"
                    name="description"
                    :label="'Descrição'"
                    :placeholder="'Descrição'"
                    class="'form-control mb-2'"
                />

                <x-form-input action="create"
                              name="duration"
                              type="number"
                              :label="'Duração'"
                              :placeholder="'Duração'"
                              class="'form-control mb-2'"
                />

            </x-form>
            <h5 class="text-center py-3">Filtros</h5>
            <div class="justify-content-center row row-cols-1 row-cols-lg-3 row-cols-md-2 gy-3 pb-5">
                <div class="col">
                    <x-form-select name="dataType"
                                   :placeholder="'Tipo de dados'"
                                   :options="['data1' => 'Tipo de dados 1', 'data2' => 'Tipo de dados 2', 'data3' => 'Tipo de dados 3']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="dataType"
                                   :placeholder="'Faixa etária'"
                                   :options="['data1' => 'Faixa etária 1', 'data2' => 'Faixa etária 2', 'data3' => 'Faixa etária 3']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="distrito"
                                   :placeholder="'Distrito'"
                                   :options="['data1' => 'distrito 1', 'data2' => 'distrito 2', 'data3' => 'distrito 3']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="sexo"
                                   :placeholder="'Sexo'"
                                   :options="['data1' => 'sexo 1', 'data2' => 'sexo 2', 'data3' => 'sexo 3']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="historial"
                                   :placeholder="'Historial médico'"
                                   :options="['data1' => 'Tipo de dados 1', 'data2' => 'Tipo de dados 2', 'data3' => 'Tipo de dados 3']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="avc"
                                   :placeholder="'AVC'"
                                   :options="['data1' => 'Sim', 'data2' => 'Não']"
                                   icon="chevron-down"
                    />
                </div>
                <div class="col">
                    <x-form-select name="diabetes"
                                   :placeholder="'Diabetes'"
                                   :options="['data1' => 'Sim', 'data2' => 'Não']"
                                   icon="chevron-down"
                    />
                </div>
            </div>
            <h5 class="text-center mt-5 mb-2">Resultados</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Tipo de dado</th>
                    <th scope="col">Idade (anos)</th>
                    <th scope="col">sexo</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">[ ]</th>
                    <td>Analise ao sangue</td>
                    <td>20</td>
                    <td>Masculino</td>
                </tr>
                <tr>
                    <th scope="row">[ ]</th>
                    <td>Analise à urina</td>
                    <td>18</td>
                    <td>Feminino</td>
                </tr>
                <tr>
                    <th scope="row">[ ]</th>
                    <td>Analises ao sangue</td>
                    <td>50</td>
                    <td>Feminino</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
