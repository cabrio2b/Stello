<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Afficher tous les Projets
    public function index()
    {
        //On récupère tous les Projets
        $projects = Project::latest()->get();
        // On transmet les Projets à la vue "/resources/views/projets/index.blade.php"
        return view('projects.index', compact('projects'));
    }

    // Créer un nouveau Projet
    public function create()
    {
        return view('projects.edit');
    }

    // Enregistrer un nouveau Projet
    public function store(Request $request)
    {
        // 1. La validation
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:255',
            'img' => 'required|image',
        ]);

        // 2. On upload l'image dans "/storage/projects"
        $img_road = $request->img->store("projects");

        // 3. On enregistre les informations du Projet
        Project::create([
            "user_id" => Auth::user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "img" => $img_road,
        ]);

        // 4. On retourne vers tous les Projets : route("Projets.index")
        return redirect(route("projects.index"));
    }

    // Afficher un Projet
    public function show(Project $project)
    {
        // coté front, je vais pouvoir utiliser une variable $projet
        return view("projects.show", compact("project"));
    }

    // Editer un Projet enregistré
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Mettre à jour un Projet
    public function update(Request $request, Project $project)
    {
        // Les règles de validation pour "name" et "desccription"
        $rules = [
            'name' => 'bail|required|string|max:30',
            'description' => 'bail|required|max:255',
        ];

        // Si une nouvelle image est envoyée
        if ($request->has("img")) {
            // On ajoute la règle de validation pour "picture"
            $rules["img"] = 'bail|required|image';
        }

        $this->validate($request, $rules);

        // On upload l'image dans "/storage/projects"
        if ($request->has("img")) {

            // On supprime l'ancienne image
            Storage::delete($project->img);

            $img_road = $request->img->store("projects");
        }

        // On met à jour les informations du project
        $project->update([
            "user_id" => Auth::user()->id,
            'name' => $request->name,
            'img' => isset($img_road) ? $img_road : $project->img,
            'description' => $request->description
        ]);

        // On affiche le project modifié : route("projects.show")
        return redirect(route("projects.show", $project));

    }

    // Supprimer un Projet
    public function destroy(Project $project)
    {
        // On supprime l'image existante
        Storage::delete($project->img);

        // On efface les informations du $project de la table "project"
        $project->delete();

        // Redirection route "projects.index"
        return redirect()->route('projects.index');
    }
}
