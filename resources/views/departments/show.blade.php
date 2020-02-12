@extends('layouts.login')

@section('content')
    <div class="container" id="single-department-wrapper">
        @include('partials/status')
        <div class="row">
            <div class="col">
                <div class="card card-body">
                    <h1 class="card-text text-center mt-2">{{ $department->name }}</h1>
                    <a class ="text-center back" href="{{ route('departments.index') }}">&laquo;&laquo;&nbsp;Tillbaka</a>
                    <a href="{{ route('departments.edit', ['department' => $department->id]) }}" class="btn btn-success btn-block">Ändra uppgifter</a>

                    <form method="POST" action="{{ route('departments.destroy', ['department' => $department->id]) }}" class="remove-department">
                        @csrf
                        @method('DELETE')

                        <input type="submit" value="Ta bort avdelningen ifrån förskolan" class="btn btn-danger btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
