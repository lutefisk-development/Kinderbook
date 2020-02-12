@extends('layouts.login')

@section('content')
    @include('partials/status')
    <div class="container" id="own-kids-wrapper">
        <h1 class="text-center mb-3 mt-3">Dina barn i Storkboet:</h1>
        <div class="row kids">
            @foreach($kids as $kid)
                <div class="col-md-4 col-lg-3 d-flex align-items-stretch">
                    <div class="card card-body mt-2 kid">   
                        @if(isset($kid->image->path))
                            <img src="{{ $kid->image->path }}" alt="" class="card-img-top img-fluid" id="kid-image">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="" class="card-img-top img-fluid" id="kid-image">
                        @endif
                        <p class="card-text text-center mt-2">{{ $kid->first_name }}&nbsp;{{ $kid->last_name }}</p>
                    <a href="{{ route('kids.show', ['kid' => $kid->id]) }}" class="btn btn-light btn-block">Ändra {{ $kid->first_name }}s uppgifter</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection