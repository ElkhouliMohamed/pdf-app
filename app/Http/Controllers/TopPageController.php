<?php

namespace App\Http\Controllers;

use App\Models\TopPage;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $topPages = TopPage::all();  // Retrieve all top pages
        return view('top_pages.index', compact('topPages'));  // Return a view with the top pages
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('top_pages.create');  // Return view for creating a new top page
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url_page' => 'required|string|max:255',
            'nb_clicks' => 'required|integer',
            'nb_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        TopPage::create($validated);  // Create a new top page record

        return redirect()->route('topPages.index');  // Redirect back to the index page
    }

    // Display the specified resource
    public function show($id)
    {
        $topPage = TopPage::findOrFail($id);  // Find a specific top page by its ID
        return view('top_pages.show', compact('topPage'));  // Return the view to show the top page
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $topPage = TopPage::findOrFail($id);  // Find the top page by its ID
        return view('top_pages.edit', compact('topPage'));  // Return view for editing the top page
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'url_page' => 'required|string|max:255',
            'nb_clicks' => 'required|integer',
            'nb_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        $topPage = TopPage::findOrFail($id);  // Find the top page
        $topPage->update($validated);  // Update the top page with the validated data

        return redirect()->route('topPages.index');  // Redirect back to the index page
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $topPage = TopPage::findOrFail($id);  // Find the top page by its ID
        $topPage->delete();  // Delete the top page

        return redirect()->route('topPages.index');  // Redirect back to the index page
    }
}
