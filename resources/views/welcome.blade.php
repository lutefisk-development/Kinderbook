@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-body">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <h1 class="text-center">Välkommen till Storkboet</h1>
                </div>
            </div>
        </div>
    </div>
@endsection