@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier {{ $property->title }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="" method="post">
            @csrf
            <!-- Génére une balise avec le token CSRF. Ce token permet
            de protéger le site contre les attaques CSRF. Laravel
            va simplement vérifier que le token envoyé correspond à celui
            de la personne qui est actuellement sur le site. -->
            <!-- <input type="hidden" name="_token" value="123456"> -->
            @method('put')
            <!-- <input type="hidden" name="_method" value="put"> -->
            <div>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $property->title }}">

                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') ?? $property->description }}</textarea>
            </div>
            <div>
                <label for="price">Prix</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ old('price') ?? $property->price }}">
            </div>
            <div class="form-check">
                <input type="checkbox" name="sold" id="sold" class="form-check-input" {{ old('sold', $property->sold) ? 'checked' : '' }}>
                <label for="sold">Vendu ?</label>
            </div>

            <button class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
