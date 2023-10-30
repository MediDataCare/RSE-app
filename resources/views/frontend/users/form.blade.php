@extends('theme.master')

@section('content')
    @if (Auth::check() && Auth::user()->data->role == 'user')
        <div class="container-fluid">
            <div class="container py-5">
                <livewire:user-form
                />
            </div>
        </div>
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
