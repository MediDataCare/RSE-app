@extends('theme.master')
@section('content')

<section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
        <img src="{{asset('assets/img/t3/backoffice.svg')}}" class="img-fluid animated">
        <h2>Bem-Vindo ao <span>Backoffice</span></h2>
        <p>Aqui pode gerir todos os formulários disponibilizados aos utilizadores</p>
        <div class="d-flex row row-cols-1 row-cols-sm-2">
            <div class="col">
                <div class="w-100 text-center mt-5">
                    <a class="btn-get-started scrollto" href="{{route('exam-type-index')}}">Listas</a>
                </div>
            </div>
            <div class="col">
                <div class="w-100 text-center mt-5">
                    <a class="btn-get-started scrollto" href="{{route('exam-type-create')}}">Criar</a>
                </div>
            </div>
        </div>
        
    </div>
  </section>

@endsection