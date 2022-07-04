@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <h2>{{ $task->name }}</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nom de la tâche</th>
                <th scope="col">Contenu</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{ $task->id }}</th>
                    <td>{{ $task->name }}</td>
                    <td>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour</a>
                        <a class="btn btn-warning" href="{{ route('tasks.edit', $task->id) }}">Modifier la tâche</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Supprimer la tâche</button>
                        </form>
                    </td>
                    <td>
                        {{-- @foreach($project->category as $categories)
                            {{ $category->id }}
                            <br>
                            {{ $category->content }}
                            <hr>
                        @endforeach --}}
                    </td>
                </tr>
            </tbody>
          </table>
    </div>
</div>

@endsection
