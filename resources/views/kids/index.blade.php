@extends('layouts.login')

@section('content')
    @include('partials/status')
    <div class="container" id="all-kids-wrapper">
        <h1 class="text-center">Alla Barn i Storkboet:</h1>
        <p class="text-center">Dagens Datum: {{(new Carbon\Carbon())->toDateString()}}</p>
        <div class="row kids">
            @foreach($kids as $kid)
                <div class="col-md-4 col-lg-3 d-flex align-items-stretch">
                    <div
                        @foreach($kid->illnesses as $illness)
                            @if((new Carbon\Carbon())->between($illness->date_start, $illness->date_end))
                                class="card card-body mt-2 kid red"
                            @endif
                        @endforeach
                        class="card card-body mt-2 kid blue"
                    >
                        @if(isset($kid->image->path))
                            <img src="{{ $kid->image->path }}" alt="" class="card-img-top img-fluid" id="kid-image">
                        @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png" alt="" class="card-img-top img-fluid" id="kid-image">
                        @endif

                        {{-- wrapping the p element in a div, to avid unwanted behavior by a eventlistener --}}
                        <div class="inside">
                            <p class="card-text text-center mt-2">{{ $kid->first_name }}&nbsp;{{ $kid->last_name }}</p>

                            @foreach($kid->illnesses as $illness)
                                @if((new Carbon\Carbon())->between($illness->date_start, $illness->date_end))
                                    <small class="text-center">Förväntas återkomma: {{ $illness->date_end }}</small>
                                @endif
                            @endforeach
                        </div>

                        @if(Auth::user()->is_admin() )
                            <a href="{{ route('kids.show', ['kid' => $kid->id]) }}" class="btn btn-light btn-block">{{ $kid->user->first_name }} {{ $kid->user->last_name }}s barn</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <h1 class="text-center">Alla barn sorterad på varje avdelning:</h1>
        <div class="card card-body">
            <div class="row departments mb-3">
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
    </div>
@endsection
