<?php

namespace App\Http\Controllers;

use App\Models\TopKeyword;
use Illuminate\Http\Request;

class TopKeywordController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $topKeywords = TopKeyword::all();  // Retrieve all top keywords
        return view('top_keywords.index', compact('topKeywords'));  // Return a view with the top keywords
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('top_keywords.create');  // Return view for creating a new top keyword
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255',
            'nb_clicks' => 'required|integer',
            'nb_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        TopKeyword::create($validated);  // Create a new top keyword record

        return redirect()->route('topKeywords.index');  // Redirect back to the index page
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
        $topKeyword = TopKeyword::findOrFail($id);  // Find the top keyword by its ID
        return view('top_keywords.edit', compact('topKeyword'));  // Return view for editing the top keyword
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

        $topKeyword = TopKeyword::findOrFail($id);  // Find the top keyword
        $topKeyword->update($validated);  // Update the top keyword with the validated data

        return redirect()->route('topKeywords.index');  // Redirect back to the index page
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $topKeyword = TopKeyword::findOrFail($id);  // Find the top keyword by its ID
        $topKeyword->delete();  // Delete the top keyword

        return redirect()->route('topKeywords.index');  // Redirect back to the index page
    }
}
