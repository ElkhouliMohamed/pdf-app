<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Rapport;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    //! start 
    public function viewRapports($projet_id)
    {
        // Find the project using the ID
        $projet = Projet::findOrFail($projet_id);

        // Fetch reports related to this project
        $rapports = Rapport::where('id_projet', $projet_id)->get();

        // Return the view with reports and project details
        return view('projets.rapports', compact('projet', 'rapports'));
    }

    //! end
    // Display a listing of the resource
    public function index()
    {
        $projets = Projet::all();  // Retrieve all projets
        return view('projets.index', compact('projets'));  // Return the view with the projets
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('projets.create');  // Return the form for creating a new projet
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'nom_projet' => 'required|string|max:255',
            'nom_siteweb' => 'nullable|string|max:255',  // Make nom_siteweb optional
            'objectif' => 'nullable|string',             // Allow objectif to be optional
            'image_path' => 'nullable|file|image|max:10240',  // Image validation (optional)
        ]);

        // Store the new projet
        $projet = new Projet();
        $projet->nom_projet = $validated['nom_projet'];
        $projet->nom_siteweb = $validated['nom_siteweb'] ?? null; // Handle optional 'nom_siteweb'
        $projet->objectif = $validated['objectif'] ?? null;       // Handle optional 'objectif'

        // Handle image upload if there's a file
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');  // Store image in 'images' directory
            $projet->image_path = $imagePath; // Save image path to the database
        }

        $projet->save(); // Save the project to the database

        // Redirect to the index route with a success message
        return redirect()->route('projets.index')->with('success', 'Projet created successfully');
    }

    // Display the specified resource
    public function show($id)
    {
        $projet = Projet::findOrFail($id);  // Find the projet by its ID
        return view('projets.show', compact('projet'));  // Return view to show the projet
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $projet = Projet::findOrFail($id);  // Find the projet
        return view('projets.edit', compact('projet'));  // Return view to edit the projet
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_projet' => 'required|string|max:255',
            'nom_siteweb' => 'nullable|string|max:255',
            'objectif' => 'nullable|string',
            'image_path' => 'nullable|file|image|max:10240',
        ]);

        $projet = Projet::findOrFail($id);  // Find the projet
        $projet->update($validated);  // Update the projet

        return redirect()->route('projets.index');  // Redirect back to the projects list
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);  // Find the projet
        $projet->delete();  // Delete the projet

        return redirect()->route('projets.index');  // Redirect back to the projects list
    }
}
