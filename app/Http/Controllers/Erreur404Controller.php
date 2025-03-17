<?php

namespace App\Http\Controllers;

use App\Models\Erreur404;
use App\Models\Rapport;
use Illuminate\Http\Request;

class Erreur404Controller extends Controller
{
    public function index()
    {
        $erreurs = Erreur404::with('rapport')->get();
        return view('erreurs404.index', compact('erreurs'));
    }

    public function create()
    {
        $rapports = Rapport::all();
        return view('erreurs404.create', compact('rapports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nb_404' => 'required|integer',
            'file_data' => 'required|string|max:255',
            'id_rapport' => 'required|exists:rapports,id_rapport'
        ]);

        Erreur404::create($validated);
        return redirect()->route('erreurs404.index')
            ->with('success', '404 Error record created successfully');
    }

    public function edit($id)
    {
        $erreur = Erreur404::findOrFail($id);
        $rapports = Rapport::all();
        return view('erreurs404.edit', compact('erreur', 'rapports'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nb_404' => 'required|integer',
            'file_data' => 'required|string|max:255',
            'id_rapport' => 'required|exists:rapports,id_rapport'
        ]);

        $erreur = Erreur404::findOrFail($id);
        $erreur->update($validated);
        return redirect()->route('erreurs404.index')
            ->with('success', '404 Error updated successfully');
    }
    public function show($id)
    {
        $erreur = Erreur404::with('rapport')->findOrFail($id);
        return view('erreurs404.show', compact('erreur'));
    }

    public function destroy($id)
    {
        $erreur = Erreur404::findOrFail($id);
        $erreur->delete();
        return redirect()->route('erreurs404.index')
            ->with('success', '404 Error deleted successfully');
    }
}
