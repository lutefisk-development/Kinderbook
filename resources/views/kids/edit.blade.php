@extends('layouts.login')

@section('content')
    <div class="container" id="edit-child-wrapper">
        <h1 class="text-center mb-3 mt-3">Här ändrar du uppgifter för {{ $kid->first_name }}:</h1>

        <form
        method="POST"
        action="{{ route('kids.update', ['kid' => $kid->id]) }}"
        id="edit-child"
        enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(Auth::user()->is_admin())
                <div class="form-group">
                    <label for="department">Välj avdelning som {{ $kid->first_name }} ska tillhöra</label>
                    <select name="department_id" id="department" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input
                        id="first_name"
                        type="hidden"
                        class="form-control"
                        name="first_name"
                        value="{{  $kid->first_name }}">
                    </div>

                    <div class="form-group col-md-6">
                        <input
                        id="last_name"
                        type="hidden"
                        class="form-control"
                        name="last_name"
                        value="{{$kid->last_name}}">
                    </div>
            @endif

            @if(Auth::user()->id === $kid->user_id)
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">Barnets förnamn:</label>
                        <input
                        id="first_name"
                        type="text"
                        class="form-control"
                        name="first_name"
                        value="{{ old('first_name') ? old('first_name') : $kid->first_name}}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="last_name">Barnets efternamn:</label>
                        <input
                        id="last_name"
                        type="text"
                        class="form-control"
                        name="last_name"
                        value="{{ old('last_name') ? old('last_name') : $kid->last_name}}">
                    </div>
                </div>

                @if(!isset($kid->image->path))
                    <div class="form-group">
                        <label for="path">Lägg upp ett kort på ditt barn:</label>
                        <input
                        id="path"
                        type="file"
                        class="form-control-file"
                        name="file">
                    </div>
                @endif

                <hr>

                <p>Sjukanmäla ditt barn:</p>

                <div class="form-row">
                    <div class="form-group col-md-6">
                    <input type="date" class="form-control mt-2" name="date_start" value="{{ old('date_start') }}" min="{{ $today }}">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" class="form-control mt-2" name="date_end" value="{{ old('date_end') }}" min="{{ $tomorrow }}">
                    </div>
                </div>
            @endif

            <!-- Displaying errors if user tries to enter false information -->
            @include('partials/errors')

            <input type="submit" class="btn btn-success btn-block mt-5" value="Ändra Uppgifter För Ditt Barn">
        </form>
    </div>
@endsection
