<!-- Button Créer une Catégorie modal -->
<div class="buttons btn-group d-grid gap-2 d-md-flex" role="group" style="margin: 3rem 0;">
    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCreateCategory">
        <i class="fa-solid fa-calendar-plus"></i> Créer une Catégorie
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCreateCategory" tabindex="-1" aria-labelledby="modalCreateCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateCategoryLabel">Création de catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- SINON Le formulaire est géré par la route "categories.store" -->
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">

                <!-- Le CSRF -->
                @csrf
                <div class="modal-body">

                    <!-- S'il y a un $category->name, on complète la valeur de l'input -->
                    <input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" placeholder="Nom de la catégorie">

                    @if($errors->has('name'))
                    <div id="validation_name" class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif

                    <p>
                        <label for="img">Choisir une image :</label><br />
                        <input class="form-control form-control-sm @if($errors->has('img')) is-invalid @endif" type="file" name="img" id="img" class="btn btn-primary mb-3">

                        <!-- Le message d'erreur pour "img" -->
                        @if($errors->has('img'))
                    <div id="validation_img" class="invalid-feedback">
                        {{ $errors->first('img') }}
                    </div>
                    @endif
                    </p>
                    <input type="hidden" name="project_id" value="{{$project->id}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
