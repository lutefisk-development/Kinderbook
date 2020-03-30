@extends('layouts.login')

@section('content')
    <div class="container" id="single-kid-wrapper">
        @include('partials/status')
        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="card card-body">
                    @if(isset($kid->image->path))
                        <img src="{{ $kid->image->path }}" alt="" class="card-img-top img-fluid" id="kid-image">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="" class="card-img-top img-fluid" id="kid-image">
                    @endif
                    <p class="card-text text-center mt-2">{{ $kid->first_name }}&nbsp;{{ $kid->last_name }}</p>
                    <p class="card-text text-center mt-2">Tillhör avdelningen: {{ $kid->department->name }}</p>
                    <p class="card-text text-center mt-2">Förälder: {{ $kid->user->first_name }} {{ $kid->user->last_name }}</p>
                    <a href="{{ route('kids.edit', ['kid' => $kid->id]) }}" class="btn btn-success btn-block">Ändra uppgifter</a>

                    <form method="POST" action="{{ route('kids.destroy', ['kid' => $kid->id]) }}" class="remove-child">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Ta bort barnet ifrån förskolan" class="btn btn-danger btn-block">
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch messages mb-2">
                <div class="card card-body">
                    <div id="single-message">
                        @foreach($messages as $message)
                            <div class="alert alert-info" role="alert">
                                {{ $message->content }}<br>
                                <small class="text-muted">skapat: {{ $message->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                    @if(Auth::user()->id === $kid->user_id)
                        <hr>
                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf

                            <input type="hidden" name="kid_id" value="{{ $kid->id }}">
                            <label for="content">Ditt meddelande:</label>
                            <textarea name="content" id="content" cols="120" class="form-control"></textarea>

                            <!-- Displaying errors if user tries to enter false information -->
                            @include('partials/errors')

                            <input type="submit" class="btn btn-success btn-block mt-5" value="Skicka meddelande">
                        </form>
                    @endif
                </div>
            </div>
        </div>
@endsection
