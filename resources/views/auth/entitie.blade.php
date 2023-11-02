@extends('theme.master')
@section('content')
    <div class="container-fluid mt-5">
        <div class="container py-5">
            <div class="section-header">
                <h2>Registar</h2>
                <p>Aqui pode criar os seus estudos para posteriormente extrair os dados.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Entidade') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register-entitie') }}">
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

{{--                                <div class="row mb-3">--}}
{{--                                    <label for="file"--}}
{{--                                           class="col-md-4 col-form-label text-md-end">{{ __('Ficheiro') }}</label>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <input id="file" type="text"--}}
{{--                                               class="form-control @error('file') is-invalid @enderror" name="file"--}}
{{--                                               value="{{ old('file') }}" required autocomplete="file" autofocus>--}}
{{--                                        @error('file')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="row mb-3">
                                    <label for="cae"
                                           class="col-md-4 col-form-label text-md-end">{{ __('Cae') }}</label>

                                    <div class="col-md-6">
                                        <input id="cae" type="number"
                                               class="form-control @error('cae') is-invalid @enderror" name="cae"
                                               value="{{ old('cae') }}" required autocomplete="cae" autofocus>

                                        @error('cae')
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

                                <input id="role" type="hidden" class="form-control" name="role" value="entitie">

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
