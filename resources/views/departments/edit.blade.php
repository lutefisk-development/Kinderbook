@extends('layouts.login')

@section('content')
    <div class="container" id="edit-department-wrapper">
        <h1 class="text-center mb-3 mt-3">Här ändrar du uppgifter för {{ $department->name }}:</h1>

        <form method="POST" action="{{ route('departments.update', ['department' => $department->id]) }}" id="edit-department">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Avdelningens namn:</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $department->name}}">
            </div>

            <!-- Displaying errors if user tries to enter false information -->
            @include('partials/errors')

            <input type="submit" class="btn btn-success btn-block mt-5" value="Ändra Uppgifter För Avdelningen">
        </form>
    </div>
@endsection
