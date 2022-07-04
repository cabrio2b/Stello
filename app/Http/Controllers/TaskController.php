<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Boolean;

class TaskController extends Controller
{
    // Afficher toutes les taches
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Créer une nouvelle tache
    public function create()
    {
        return view('tasks.create');
    }

    // Enregistrer une nouvelle tache
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:30',
        ]);

        Task::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);
        return back()->withInput();

    }

    // Afficher une tache
    public function show($id)
    {
        // coté front, je vais pouvoir utiliser une variable $task
        return view("tasks.show", compact("task"));
    }

    // Editer une tache enregistrée
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Mettre à jour une tache
    public function update(Request $request, Task $task)
    {
        // Les règles de validation pour "name"
        $rules = [
            'name' => 'required|string|max:30',
            'statut' => 'boolean',
        ];

        $this->validate($request, $rules);

        // On met à jour les informations de la tache
        $task->update([
            'name' => $request->name,
            'statut' => $request->statut,
        ]);

        // On affiche la tache modifié
        return back()->withInput();

    }

    // Supprimer une tache
    public function destroy(Task $task)
    {
        $task->delete();

        return back()->withInput();
    }
}
