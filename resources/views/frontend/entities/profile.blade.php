@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="container mt-5">
            @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                <livewire:study-table
                />
            @endif
        </div>
    </div>
@endsection
