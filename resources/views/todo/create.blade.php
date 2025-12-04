@extends('layouts')

@section('content')
    <div class="container mt-5">
        <h2>Ajouter une nouvelle tâche</h2>
        <form action="{{ route('todo.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2">Ajouter</button>
            <a href="{{ route('todo.index') }}" class="btn btn-secondary mt-2">Retour</a>
        </form>
    </div>
@endsection