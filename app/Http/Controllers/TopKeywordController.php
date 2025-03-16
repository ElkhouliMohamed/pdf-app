<?php

namespace App\Http\Controllers;

use App\Models\TopKeyword;
use App\Models\Rapport;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopKeywordController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $topKeywords = TopKeyword::all();
        return view('top_keywords.index', compact('topKeywords'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        // Assuming you have the relationship 'projet' defined on the Rapport model
        $rapports_projets = Rapport::with('projet')->get();  // Load rapports with their related projet
        return view('top_keywords.create', compact('rapports_projets'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'keyword' => 'required|string|max:255',  // Validate the keyword
            'nombre_requetes' => 'required|integer|min:0',  // Validate nombre_requetes
            'id_rapport' => 'required|exists:rapports,id_rapport',  // Validate rapport ID
        ]);

        // Create the new TopKeyword entry
        TopKeyword::create([
            'keyword' => $validatedData['keyword'],  // Save the keyword
            'nombre_requetes' => $validatedData['nombre_requetes'],  // Save nombre_requetes
            'id_rapport' => $validatedData['id_rapport'],  // Save the rapport ID
            'created_at' => now(),  // Set created_at timestamp
            'updated_at' => now(),  // Set updated_at timestamp
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('topKeywords.index')->with('success', 'Top Keyword added successfully!');
    }






    // Display the specified resource
    public function show($id)
    {
        $topKeyword = TopKeyword::findOrFail($id);  // Find a specific top keyword by its ID
        return view('top_keywords.show', compact('topKeyword'));  // Return the view to show the top keyword
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $topKeyword = TopKeyword::findOrFail($id);
        $rapports_projets = Rapport::with('projet')->get(); // Load rapports with their related projets

        return view('top_keywords.edit', compact('topKeyword', 'rapports_projets'));
    }



    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255',
            'nb_clicks' => 'required|integer',
            'nb_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        $topKeyword = TopKeyword::findOrFail($id);
        $topKeyword->update($validated);

        return redirect()->route('topKeywords.index')->with('success', 'Top Keyword updated successfully!');
    }


    // Remove the specified resource from storage
    public function destroy($id)
    {
        $topKeyword = TopKeyword::findOrFail($id);  // Find the top keyword by its ID
        $topKeyword->delete();  // Delete the top keyword

        return redirect()->route('topKeywords.index');  // Redirect back to the index page
    }
}
