@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <a class="btn btn-primary col-4" href="{{ route('tasks.create') }}">Créer une tâche</a>
    </div>
    <br>
    <div class="row">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Titre</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <th>{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('tasks.show', $task->id) }}">Voir la tâche</a>
                        <a class="btn btn-warning" href="{{ route('tasks.edit', $task->id) }}">Modifier la tâche</a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" type="submit">Supprimer la tâche</button>                    </td>
                        </form>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection
