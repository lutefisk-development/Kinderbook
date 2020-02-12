@extends('layouts.login')

@section('content')
    @include('partials/status')
    <div class="container" id="all-departments-wrapper">
        <h1 class="text-center">Alla avdelningar på Storkboet:</h1>
        <div class="list-group">
            @foreach($departments as $department)
        <a href="{{ route('departments.show', ['department' => $department->id]) }}" class="list-group-item list-group-item-action text-center"> {{ $department->name   }}</a>
            @endforeach
        </div>
    </div>
@endsection