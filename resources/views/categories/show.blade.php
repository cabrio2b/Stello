<div class="container">
    <div class="row gap-3 justify-content-center">

        @foreach ($project->categories as $category)
        <div class="card col-3" style="width: 18rem;">
            <img src="{{ asset('storage/'.$category->img) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$category->name}}</h5>
                @include('tasks.create')
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($category->tasks as $task)
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    <li class="task list-group-item">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>

                        {{$task->name}}
                        <a type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditTask<?= $task->id ?>" title="éditer {{$task->name}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        @csrf
                        @method('DELETE')
                        <!-- Button Créer une Catégorie modal -->
                        <button type="submit" class="btn btn-outline-danger btn-sm" title="supprimer {{$task->name}}"><i class="fa-solid fa-trash-can"></i></button>
                    </li>
                </form>
                @include('tasks.edit')
                @endforeach
            </ul>
            <div class="card-body">
                <div class="buttons btn-group d-grid gap-2 d-md-flex justify-content-md-end" role="group">
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <!-- Button Créer une Catégorie modal -->
                        <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalEditCategoryLabel<?= $category->id ?>" title="éditer {{$category->name}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button type="submit" class="btn btn-outline-danger" title="supprimer {{$category->name}}"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                    @include('categories.edit')
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
