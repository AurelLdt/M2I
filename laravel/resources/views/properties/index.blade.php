@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-around align-items-center my-4">
            <h1>Nos annonces</h1>
            <a href="/annonce/creer" class="btn btn-primary">
                Créer une annonce
            </a>
        </div>

        {{-- old() permet de récupèrer le withInput(). Ce sont les
            données de la requète précédente. --}}
        @if (old())
            <div class="alert alert-success">
                L'annonce {{ old('title') }} a été ajoutée avec succès.
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            @foreach ($properties as $property)
                <div class="col-lg-3">
                    <div class="card text-center mb-4">
                        <img src="{{ $property->image }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description, 25) }}</p>
                            <a href="/annonce/{{ $property->id }}" class="btn btn-primary">Voir l'annonce</a>
                            <a href="/annonce/editer/{{ $property->id }}" class="btn btn-secondary">Editer l'annonce</a>
                            <form action="/annonce/{{ $property->id }}"
                                method="post"
                                onsubmit="return confirm('Voulez-vous supprimer cette annonce ?')"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Supprimer l'annonce</button>
                            </form>
                        </div>
                        <div class="card-footer text-muted">
                            {{ number_format($property->price) }} €
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
