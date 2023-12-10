@extends('theme.master')

@section('content')
    <div class="container-fluid">
        <div class="container py-5">
            <livewire:entitie-form
                :action="$action"
            />
        </div>
    </div>
@endsection
