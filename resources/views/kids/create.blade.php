@extends('layouts.login')

@section('content')
    <div class="container" id="add-child-wrapper">
        <h1 class="text-center mb-3 mt-3">Här skriver du in uppgifter för att registrera ditt barn:</h1>

        <form method="POST" action="{{ route('kids.store') }}" id="add-child" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="first_name">Barnets förnamn:</label>
                    <input 
                    id="first_name" 
                    type="text" 
                    class="form-control" 
                    name="first_name"
                    value="{{ old('first_name') }}" 
                    placeholder="Förnamn">
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Barnets efternamn:</label>
                    <input 
                    id="last_name"
                    type="text"
                    class="form-control"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    placeholder="Efternamn">
                </div>
            </div>

            <div class="form-group">
                <label for="path">Lägg upp ett kort på ditt barn:</label>
                <input 
                id="path" 
                type="file" 
                class="form-control-file" 
                name="file">
            </div>

            <!-- Displaying errors if user tries to enter false information -->
            @include('partials/errors')

            <input type="submit" class="btn btn-success btn-block mt-5" value="Registrera Ditt Barn">
        </form>
    </div>
@endsection