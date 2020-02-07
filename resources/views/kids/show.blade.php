@extends('layouts.login')

@section('content')
    <div class="container" id="single-kid-wrapper">
        @include('partials/status')
        <div class="row">
            <div class="col-md-6">
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
                <a href="#" class="btn btn-danger btn-block">Ta bort barnet ifrån förskolan</a>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-stretch messages">
                <div class="card card-body">
                    <div id="single-message">
                        @foreach($messages as $message)
                            <div class="alert alert-info" role="alert">
                                {{ $message->content }}
                            </div>
                        @endforeach
                    </div>
                    @if(Auth::user()->id === $kid->user_id)
                        <hr>
                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf

                            <input type="hidden" name="kid_id" value="{{ $kid->id }}">
                            <label for="content">Ditt meddelande:</label>
                            <textarea name="content" id="content" cols="120"></textarea>

                            <!-- Displaying errors if user tries to enter false information -->
                            @include('partials/errors')

                            <input type="submit" class="btn btn-success btn-block mt-5" value="Skicka meddelande">
                        </form>
                    @endif
                </div>
            </div>
        </div>
@endsection 