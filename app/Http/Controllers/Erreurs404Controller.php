<?php

namespace App\Http\Controllers;

use App\Models\Erreurs404;
use Illuminate\Http\Request;

class Erreurs404Controller extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $erreurs404 = Erreurs404::all();  // Retrieve all Erreurs 404
        return view('erreurs404.index', compact('erreurs404'));  // Return view with the errors
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('erreurs404.create');  // Return the form for creating a new error
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'count' => 'required|integer',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        Erreurs404::create($validated);  // Create the error record

        return redirect()->route('erreurs404.index');  // Redirect back to the errors list
    }

    // Display the specified resource
    public function show($id)
    {
        $erreurs404 = Erreurs404::findOrFail($id);  // Find the error by its ID
        return view('erreurs404.show', compact('erreurs404'));  // Return view to show the error
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $erreurs404 = Erreurs404::findOrFail($id);  // Find the error by its ID
        return view('erreurs404.edit', compact('erreurs404'));  // Return view to edit the error
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'url' => 'required|string|max:255',
            'count' => 'required|integer',
            'id_rapport' => 'required|exists:rapports,id_rapport',
        ]);

        $erreurs404 = Erreurs404::findOrFail($id);  // Find the error
        $erreurs404->update($validated);  // Update the error

        return redirect()->route('erreurs404.index');  // Redirect back to the errors list
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $erreurs404 = Erreurs404::findOrFail($id);  // Find the error
        $erreurs404->delete();  // Delete the error

        return redirect()->route('erreurs404.index');  // Redirect back to the errors list
    }
}
