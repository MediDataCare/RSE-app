@extends('theme.master')
@section('content')
    <div class="container-fluid">
        <div class="container mt-5" style="margin-top:7rem!Important">
            @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                <livewire:study-table
                />
            @endif
        </div>
    </div>
@endsection
