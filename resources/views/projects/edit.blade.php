@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Si nous avons un projet $projet, Le formulaire est géré par la route "projets.update" -->
    @if (isset($project))
    <form method="POST" action="{{ route('projects.update', $project) }}" enctype="multipart/form-data">
        @method('PUT')

        @else
        <!-- SINON Le formulaire est géré par la route "projets.store" -->
        <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
            @endif

            <!-- Le CSRF -->
            @csrf

            <div class="card">
                <div class="card-body">
                    <div class="card-body buttons btn-group" role="group" aria-label="Goupe de bouton">
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i> Retour</a>
                        <button type="submit" name="valider" value="Valider" class="btn btn-outline-success"><i class="fa-solid fa-circle-check"></i> Valider</button>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                @if(isset($project->img))
                                <img src="{{ asset('storage/'.$project->img) }}" alt="Image de couverture actuelle" class="card-img-top" style="max-height: 400px;">
                                @else
                                <img src="{{ asset('images/hero.webp') }}" alt="Image de couverture actuelle" class="card-img-top" style="max-height: 400px;">
                                @endif
                            </div>

                            <div class="col-8">
                                <h5 class="card-title">Titre du projet</h5>

                                <!-- S'il y a un $project->name, on complète la valeur de l'input -->
                                <div class="mb-3">
                                    <input value="{{ $project->name ?? old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" placeholder="Nom du projet...">
                                </div>
                                <!-- Le message d'erreur pour "name" -->
                                @if($errors->has('name'))
                                <div id="validation_name" class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif

                                <!-- S'il y a un $project->description, on complète la valeur de l'input -->
                                <div class="mb-3">
                                    <h5 class="card-title">Description du projet</h5>
                                    <textarea value="{{ $project->description ?? old('description') }}" class="form-control @if($errors->has('description')) is-invalid @endif" name="description" id="description" rows="2" placeholder="Description du projet...">{{ $project->description ?? old('description') }}</textarea>
                                </div>
                                <!-- Le message d'erreur pour "description" -->
                                @if($errors->has('description'))
                                <div id="validation_description" class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                                @endif

                                <h5 class="card-title">Image de couverture</h5>
                                <p>
                                    <label for="img">Choisir :</label><br />
                                    <input class="form-control form-control-sm @if($errors->has('img')) is-invalid @endif" type="file" name="img" id="img" class="btn btn-primary mb-3">
                                    <!-- Le message d'erreur pour "img" -->
                                    @if($errors->has('img'))
                                <div id="validation_img" class="invalid-feedback">
                                    {{ $errors->first('img') }}
                                </div>
                                @endif
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="card-body buttons btn-group" role="group" aria-label="Goupe de bouton">
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-backward"></i> Retour</a>
                        <button type="submit" name="valider" value="Valider" class="btn btn-outline-success"><i class="fa-solid fa-circle-check"></i> Valider</button>
                    </div>
                </div>
            </div>
        </form>

</div>
@endsection
