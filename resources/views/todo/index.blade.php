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

                    <!-- Formulaire de suppression avec SweetAlert2 -->
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $todo->id }})">Supprimer</button>

                    <form id="delete-form-{{ $todo->id }}" action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<script>
    function confirmDelete(todoId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas annuler cela !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + todoId).submit();
            }
        })
    }
</script>
@endsection