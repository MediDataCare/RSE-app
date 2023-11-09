@extends('theme.master')
@section('content')

    <div class="container-fluid">
        <div class="container py-5">
            <livewire:exam-type-form
                :examType="$examType"
                :action="$action"
            />
        </div>
    </div>
@endsection
