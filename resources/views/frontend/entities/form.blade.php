@extends('theme.master')

@section('content')
    @if (Auth::check() && (Auth::user()->data->role == 'entitie' || !empty(Auth::user()->data->entitie)))
        <div class="container-fluid">
            <div class="container py-5">
                <livewire:entitie-form
                    :action="$action"
                />
            </div>
        </div>
    @else
        <script>window.location = "/";</script>
    @endif
@endsection
