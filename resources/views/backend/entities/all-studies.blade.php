@extends('theme.master')
@section('content')
    <div class="container-fluid">
        <div class="container py-5">
            <livewire:study-table
                :entitiesId="$entitiesId"
            />
        </div>
    </div>
@endsection
