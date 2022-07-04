<style>
    #image {
        background-image: url('{{ asset("storage/".$project->img) }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 100% auto;
        border-radius: 0.5rem;
    }
</style>

@extends('layouts.app')

@section('content')
<div class="container">

    <div id="image" class="row imageProjectFond">

        <div id="imageProjectFond" class="card">
            <h5 class="card-header">{{ $project->name }}</h5>
            <div class="card-body">
                <h5 class="card-title">{{ $project->description }}</h5>
                <p class="card-text">Ligne pour le statut</p>
                <div class="buttons btn-group d-grid gap-2 d-md-flex justify-content-md-end" role="group">
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i> Retour</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-outline-info" title="éditer {{ $project->name }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button type="submit" class="btn btn-outline-danger" title="supprimer {{ $project->name }}"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
                @include('categories.show')
                @include('categories.create')
            </div>
        </div>

    </div>
</div>

@endsection
