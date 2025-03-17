<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\TopPage;
use Illuminate\Http\Request;

class TopPageController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $topPages = TopPage::all();
        $rapports = Rapport::all(); // Retrieve all top pages
        return view('top_pages.index', compact('topPages' , 'rapports'));  // Return a view with the top pages
    }

    // Show the form for creating a new resource
    public function create()
    {
        $rapports = Rapport::all(); // Fetch all rapports
        return view('top_pages.create', compact('rapports')); // Pass rapports to the view
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url_page' => 'required|string|max:255',
            'nombre_visites' => 'required|integer',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        TopPage::create($validated);
        return redirect()->route('topPages.index');
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
        $topPage = TopPage::findOrFail($id);
        $rapports = Rapport::all(); // Fetch all rapports
        return view('top_pages.edit', compact('topPage', 'rapports')); // Pass rapports to the view
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'url_page' => 'required|string|max:255',
            'nombre_visites' => 'required|integer',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        $topPage = TopPage::findOrFail($id);
        $topPage->update($validated);
        return redirect()->route('topPages.index');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $topPage = TopPage::findOrFail($id);
        $topPage->delete();
        return redirect()->route('topPages.index');
    }
}
