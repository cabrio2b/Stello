<div class="buttons btn-group d-grid gap-2 d-md-flex" role="group" aria-label="Basic outlined example">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCreateTask<?= $category->id ?>">
        Créer une Tache
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCreateTask<?= $category->id ?>" tabindex="-1" aria-labelledby="modalCreateTask<?= $category->id ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTaskLabel<?= $category->id ?>">Création de tache</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- SINON Le formulaire est géré par la route "categories.store" -->
            <form method="POST" action="{{ route('tasks.store', $project->id) }}">

                <!-- Le CSRF -->
                @csrf
                <div class="modal-body">

                    <!-- S'il y a un $Task->name, on complète la valeur de l'input -->
                    <input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" placeholder="Nom de la tache">

                    @if($errors->has('name'))
                    <div id="validation_name" class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                    <input type="hidden" name="category_id" value="{{$category->id}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-rectangle-xmark"></i></button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
