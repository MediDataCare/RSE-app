@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Características do Utilizador</h2>
                <!-- <p>Todas as Entidades Registadas na Plataforma estão visíveis abaixo, o seu registo pode ser Aprovado ou Rejeitado
                    <br>Para observar os Estudos de uma Entidade por favor selecione a mesma</p> -->
            </div>
            <div class="row mb-3">
                <div class="col-6 d-flex align-items-center ">
                    <a href="{{ route('users-index') }}">
                        <i class="fas fa-arrow-left fs-4"></i>
                    </a>
                </div>
                @if(empty(data_get($user, 'data.accepted', [])) && empty(data_get($user, 'data.rejected', [])))
                    <div class="col-6 text-end btn-form">
                        <button onclick="window.location.href='{{ route('users-edit', ['id' => $user->id]) }}'">
                            {{ 'Editar User' }}
                        </button>
                    </div>
                @endif
            </div>
            
            <b>
                <x-form-input action="show"
                              name="name"
                              :label="'Nome'"
                              :placeholder="'Nome'"
                              class="form-control mb-3"
                              :value="data_get($user, 'name')"
                              readonly
                />
            </b>
            <b>
                <x-form-input
                    action="show"
                    name="email"
                    :label="'Email'"
                    :placeholder="'Email'"
                    class="form-control mb-3"
                    :value="data_get($user, 'email')"
                    readonly
                />
            </b>
            <b>
                <x-form method="POST" action="{{ route('users-update', ['id' => $user->id]) }}">
                    <x-form-select
                        action="show"
                        name="new_role"
                        :label="'Role'"
                        :options="[
                            'admin' => 'Administrador',
                            'manager' => 'Manager',
                            'entitie' => 'Entidade',
                            'user' => 'Utilizador',
                        ]"
                        :default="old('new_role', $user->data->role)"
                        class="form-control mb-3"
                    />
                    <div class="col">
                        <div class="w-100 text-center btn-form mt-5">
                            <button type="submit">
                                {{ 'Guardar' }}
                            </button>
                        </div>
                    </div>
                </x-form>
            </b>
        </div>
    </div>
@endsection
