@extends('layouts')

@section('content')
<div class="container mt-5">
    <h2>Liste des tâches</h2>
    <a href="{{ route('todo.create') }}" class="btn btn-primary mb-3">Ajouter une tâche</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @foreach($todos as $todo)
            <li class="list-group-item">
                <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="complete" onChange="this.form.submit()" {{ $todo->complete ? 'checked' : '' }}>
                    {{ $todo->titre }}
                </form>
                <p>{{ $todo->description }}</p>
                <div class="float-right">
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-info btn-sm">Modifier</a>

                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression de cette tâche ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection