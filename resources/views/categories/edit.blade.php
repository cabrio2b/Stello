<!-- Modal -->
<div class="modal fade" id="modalEditCategoryLabel<?= $category->id ?>" tabindex="-1" aria-labelledby="modalEditCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditCategoryLabel<?= $category->id ?>">Création de catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Le formulaire est géré par la route "categories.store" -->
            <form method="POST" action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
                @method('PUT')
                <!-- Le CSRF -->
                @csrf

                <div class="modal-body">

                    <!-- S'il y a un $category->name, on complète la valeur de l'input -->
                    <input value="{{ $category->name ?? old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" placeholder="Nom de la catégorie">

                    @if($errors->has('name'))
                    <div id="validation_name" class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif

                    <div class="card-body">
                        @if(isset($category->img))
                        <img src="{{ asset('storage/'.$category->img) }}" alt="Image de couverture actuelle" class="card-img-top" style="max-height: 250px;">
                        @endif
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

                    <input type="hidden" name="category_id" value="{{$category->id}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-outline-primary">Sauvegarder</button>
                </div>
            </form>

        </div>
    </div>
</div>
