<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    // Afficher toutes les Categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Créer une nouvelle Categorie
    public function create($id)
    {
        $project = Project::findOrFail($id);
        return view('categories.create', compact('project'));
    }

    // Enregistrer une nouvelle Categorie
    public function store(Request $request)
    {
        dd($request->img);
        // 1. La validation
        $this->validate($request, [
            'name' => 'required|string|max:30',
            'img' => 'required|image',
        ]);

        // 2. On upload l'image dans "/storage/categories"
        $img_road = $request->img->store("categories");
        $project_id = $request->input('project_id');

        // 3. On enregistre les informations du Projet
        Category::create([
            'name' => $request->input('name'),
            'project_id' => $project_id,
            "img" => $img_road,

        ]);

        // 4. On retourne vers le Projet en cours : route("Projets.index")
        return back()->withInput();

    }

    // Afficher une Categorie
    public function show(Category $category)
    {
        // $category = Project::with('category')->find($id);

        // coté front, je vais pouvoir utiliser une variable $post
        return view("categories.show", compact("category"));
    }

    // Editer une Categorie enregistré
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Mettre à jour une Categorie
    public function update(Request $request, category $category)
    {
        //dd($request,$category);
        // Les règles de validation pour "name"
        $rules = [
            'name' => 'bail|required|string|max:30',
        ];

        // Si une nouvelle image est envoyée
        if ($request->has('img')) {
            // On ajoute la règle de validation pour "picture"
            $rules['img'] = 'bail|required|image';
        }

        $this->validate($request, $rules);

        // On upload l'image dans "/storage/categories"
        if ($request->has("img")) {

            // On supprime l'ancienne image
            Storage::delete($category->img);

            $img_road = $request->img->store("categories");
        }

        // On met à jour les informations de la categorie
        $category->update([
            'name' => $request->name,
            'img' => isset($img_road) ? $img_road : $category->img,
        ]);

        // On affiche le project modifié : route("projects.show")
        return redirect(route("projects.index"));
    }

    // Supprimer une Categorie
    public function destroy( Category $category )
    {
        // On supprime l'image existante
        Storage::delete($category->img);

        // On efface les informations du $category de la table "categories"
        $category->delete();

        // Redirection route "projects.index"
        return redirect()->route('projects.index');

    }

}
