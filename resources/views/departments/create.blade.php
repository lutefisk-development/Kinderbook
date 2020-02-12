@extends('layouts.login')

@section('content')
    <div class="container" id="add-department-wrapper">
        <h1 class="text-center mb-3 mt-3">Här skriver du in uppgifter för att skapa en ny avdelning:</h1>

        <form method="POST" action="{{ route('departments.store') }}" id="add-department">
            @csrf

            <div class="form-group">
                <label for="name">Vad avdelningen ska heta:</label>
                <input 
                id="name"
                type="text" 
                class="form-control"
                name="name"
                value="{{ old('name') }}">
            </div>

            <!-- Displaying errors if user tries to enter false information -->
            @include('partials/errors')

            <input type="submit" class="btn btn-success btn-block mt-5" value="Registrera Ny Avdelning">
        </form>
    </div>
@endsection