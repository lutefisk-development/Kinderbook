@extends('layouts.login')

@section('content')
    @include('partials/status')
    <div class="container" id="all-announcements-wrapper">
        <h1 class="text-center mb-3 mt-3">Alla meddelande:</h1>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @if(Auth::user()->is_admin())
                    <form method="POST" action="{{ route('announcements.store') }}" id="add-announcement" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Titel på meddelande:</label>
                            <input
                            id="title"
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Titel">
                        </div>

                        <div class="form-group">
                            <label for="content">Meddelande:</label>
                            <textarea name="content" id="content" cols="120" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="department">Välj avdelning som meddelande ska tillhöra</label>
                            <select name="department_id" id="department" class="form-control">
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="path">Lägg upp ett kort på ditt meddelande:</label>
                            <input
                            id="path"
                            type="file"
                            class="form-control-file"
                            name="file">
                        </div>

                        <!-- Displaying errors if user tries to enter false information -->
                        @include('partials/errors')

                        <input type="submit" class="btn btn-success btn-block mt-5" value="Skapa meddelande">

                    </form>
                    <hr>
                @endif
            </div>
            <div class="col-md-8 offset-md-2">

                <!-- PAGINATION -->
                {{ $announcements->links() }}

                @foreach($announcements as $announcement)
                    <div class="card">
                        @if(isset($announcement->image->path))
                            <img src="{{ $announcement->image->path }}" alt="" class="card-img-top img-fluid" id="announcement-image">
                        @else
                            <img src="https://via.placeholder.com/350" alt="" class="card-img-top img-fluid" id="announcement-image">
                        @endif

                        <div class="card-body">
                            <h1 class="card-title">{{ $announcement->title }}</h1>
                            <p class="card-text">{{ $announcement->content }}</p>
                        </div>

                        @if(isset($announcement->created_at))
                            <div class="card-footer text-muted">
                                <small>skapat: {{ $announcement->created_at->diffForHumans() }}</small>
                                <span>
                                    <small>av {{ $announcement->department->name }} avdelningen</small>
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
