@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="container mt-5">
            <a class="btn btn-primary" href="{{route('exam-type-create')}}">
                {{'Criar'}}
            </a>
            <livewire:exam-type-table
            />
        </div>
    </div>
@endsection
