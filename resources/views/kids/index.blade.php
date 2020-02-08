@extends('layouts.login')

@section('content')
    @include('partials/status')
    <div class="container" id="all-kids-wrapper">
        <h1 class="text-center mb-3 mt-3">Alla Avdelningar i Storkboet:</h1>
        <div class="row departments mb-3">
            <div class="card card-body">
                @foreach($departments as $department)
                    <div class="col-sm-6 col-md-3">
                        <h2>{{ $department->name }}:</h2>
                        @foreach($department->kids as $kid)
                    <p>{{$kid->first_name}}&nbsp;{{ $kid->last_name }}</p>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <h1 class="text-center mb-3 mt-3">Alla Barn i Storkboet:</h1>
        <div class="row kids">
            @foreach($kids as $kid)
        <kids kid="{{ $kid }}"></kids>
                <div class="col-md-4 col-lg-3 d-flex align-items-stretch">
                    <div 
                        class="card card-body mt-2 kid"
                        @if($kid->is_present == 1)
                            style="background-color: #CB5255"
                        @endif
                    >   
                        
                        @if(isset($kid->image->path))
                            <img src="{{ $kid->image->path }}" alt="" class="card-img-top img-fluid" id="kid-image">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="" class="card-img-top img-fluid" id="kid-image">
                        @endif
                        <p class="card-text text-center mt-2">{{ $kid->first_name }}&nbsp;{{ $kid->last_name }}</p>

                        @if(Auth::id() === $kid->user->id || Auth::user()->is_admin() )
                            <a href="{{ route('kids.show', ['kid' => $kid->id]) }}" class="btn btn-light btn-block">{{ $kid->user->first_name }}s barn</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection