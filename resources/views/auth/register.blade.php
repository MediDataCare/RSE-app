@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Registar Utilizador</h2>
                <p>Crie a sua conta e comece já a ganhar recompensas pela partilha dos seus dados!</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Utilizador') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="age"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Idade') }}</label>

                                    <div class="col-md-6">
                                        <input id="age" type="number"
                                               class="form-control @error('age') is-invalid @enderror" name="age"
                                               value="{{ old('age') }}" required autocomplete="age" autofocus>

                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="sex"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Sexo') }}</label>

                                    <div class="col-md-6">
                                        <select id="sex" type="number"
                                                class="form-control @error('sex') is-invalid @enderror"
                                                name="sex" required>
                                            <option value="">Sexo</option>
                                            <option value="male">Masculino</option>
                                            <option value="female">Feminino</option>
                                            <option value="other">Outro</option>
                                        </select>
                                        @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="local"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Distrito') }}</label>

                                    <div class="col-md-6">
                                        <select id="local" class="form-control @error('local') is-invalid @enderror"
                                                name="local" required>
                                            <option value="">Selecione um distrito</option>
                                            <option value="Aveiro">Aveiro</option>
                                            <option value="Beja">Beja</option>
                                            <option value="Braga">Braga</option>
                                            <option value="Bragança">Bragança</option>
                                            <option value="Castelo Branco">Castelo Branco</option>
                                            <option value="Coimbra">Coimbra</option>
                                            <option value="Évora">Évora</option>
                                            <option value="Faro">Faro</option>
                                            <option value="Guarda">Guarda</option>
                                            <option value="Leiria">Leiria</option>
                                            <option value="Lisboa">Lisboa</option>
                                            <option value="Madeira">Madeira</option>
                                            <option value="Portalegre">Portalegre</option>
                                            <option value="Porto">Porto</option>
                                            <option value="Santarém">Santarém</option>
                                            <option value="Setúbal">Setúbal</option>
                                            <option value="Viana do Castelo">Viana do Castelo</option>
                                            <option value="Vila Real">Vila Real</option>
                                            <option value="Viseu">Viseu</option>
                                        </select>
                                        @error('local')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <input id="role" type="hidden" class="form-control" name="role" value="user">
                                
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4 btn-form">
                                        <button type="submit">
                                            {{ __('Registar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
