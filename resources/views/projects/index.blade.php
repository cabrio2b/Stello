@extends('layouts.app')

@section('content')
<div class="container">
    <div class="buttons row" style="margin: 3rem 0;">
        <a class="btn btn-outline-success" href="{{ route('projects.create') }}" title="Créer un projet"><i class="fa-solid fa-folder-plus"></i> Créer un projet</a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($projects as $project)
        <div class="col">
            <div class="card">
                <style>
                    .imageProject<?= $project->id ?> {
                        background-image: url('{{ asset("storage/".$project->img) }}');
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: 100% auto;
                        border-radius: 0.5rem;
                        display: table;
                        width: 100%;
                        height: 400px;
                        max-height: fit-content;
                        text-align: center;
                    }
                </style>

                <div class="imageProject<?= $project->id ?>"></div>

                <div class="card-body">
                    <h5 class="card-title">{{ $project->name }}</h5>
                    <p class="card-text">{{ $project->description }}</p>
                </div>
                <div class="card-body buttons btn-group" role="group" aria-label="Goupe de bouton">
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-secondary" title="consulter {{ $project->name }}"><i class="fa-solid fa-eye"></i> Consulter : {{ $project->name }}</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-info" title="éditer {{ $project->name }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button type="submit" class="btn btn-outline-danger" title="supprimer {{ $project->name }}"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="buttons row" style="margin: 3rem 0;">
        <a class="btn btn-outline-success" href="{{ route('projects.create') }}" title="Créer un projet"><i class="fa-solid fa-folder-plus"></i> Créer un projet</a>
    </div>

</div>
@endsection
