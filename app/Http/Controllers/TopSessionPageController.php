<?php

namespace App\Http\Controllers;

use App\Models\TopSessionPage;
use App\Models\Rapport; // Assuming Rapport model exists
use Illuminate\Http\Request;

class TopSessionPageController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Get all top session pages
        $topSessionPages = TopSessionPage::all();
        return view('top_session_pages.index', compact('topSessionPages'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $rapports = Rapport::all();  // Get rapports to assign to session page
        return view('top_session_pages.create', compact('rapports'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'url_page' => 'required|string|max:255',
            'duree_moyenne' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport', // Ensure that the rapport exists
        ]);

        // Create the new top session page
        TopSessionPage::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('topSessionPages.index')->with('success', 'Session Page added successfully!');
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $topSessionPage = TopSessionPage::findOrFail($id);
        $rapports = Rapport::all();  // Get rapports for the edit form
        return view('top_session_pages.edit', compact('topSessionPage', 'rapports'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // Validate input
        $validatedData = $request->validate([
            'url_page' => 'required|string|max:255',
            'duree_moyenne' => 'required|numeric',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        // Find and update the session page
        $topSessionPage = TopSessionPage::findOrFail($id);
        $topSessionPage->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('topSessionPages.index')->with('success', 'Session Page updated successfully!');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $topSessionPage = TopSessionPage::findOrFail($id);
        $topSessionPage->delete();

        // Redirect to the index page with a success message
        return redirect()->route('topSessionPages.index')->with('success', 'Session Page deleted successfully!');
    }
}
