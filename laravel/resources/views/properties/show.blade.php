@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                IMAGE
            </div>
            <div class="col-lg-6">
                <h1 class="my-4 text-center">{{ $property->title }}</h1>
                <p>{{ $property->description }}</p>
                <p>{{ number_format($property->price) }} €</p>
            </div>
        </div>
    </div>
@endsection
