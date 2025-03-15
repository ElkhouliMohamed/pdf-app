<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Models\Projet;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;


class RapportController extends Controller
{
    //!   for rapports of a project
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
        $rapports = Rapport::all();
        return view('rapports.index', compact('rapports'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $projets = Projet::all();
        return view('rapports.create', compact('projets'));
    }
    
    // Store method
    public function store(Request $request)
    {
        // Ensure that the periode is being correctly parsed as a date object
        $periode = Carbon::parse($request->periode . '-01')->format('Y-m-d');

        $validated = $request->validate([
            'id_projet' => 'required|exists:projets,id_projet',
            'nom_rapport' => 'required|string|max:255',
            'periode' => 'required|date',
            'total_clicks' => 'required|integer',
            'total_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'nb_sessions' => 'required|integer',
            'nb_active_users' => 'required|integer',
            'nb_new_users' => 'required|integer',
            'page_speed' => 'required|numeric',
            'performance' => 'required|numeric',
            'accessibility' => 'required|numeric',
            'best_practices' => 'required|numeric',
            'seo' => 'required|numeric',
            'nb_backlinks' => 'required|integer',
            'nb_orders' => 'required|integer',
            'nb_cart' => 'required|integer',
        ]);

        // Create a new rapport
        Rapport::create([
            'id_projet' => $validated['id_projet'],
            'nom_rapport' => $validated['nom_rapport'],
            'periode' => $periode,  // Store the valid date (YYYY-MM-01)
            'total_clicks' => $validated['total_clicks'],
            'total_impressions' => $validated['total_impressions'],
            'avg_ctr' => $validated['avg_ctr'],
            'avg_position' => $validated['avg_position'],
            'nb_sessions' => $validated['nb_sessions'],
            'nb_active_users' => $validated['nb_active_users'],
            'nb_new_users' => $validated['nb_new_users'],
            'page_speed' => $validated['page_speed'],
            'performance' => $validated['performance'],
            'accessibility' => $validated['accessibility'],
            'best_practices' => $validated['best_practices'],
            'seo' => $validated['seo'],
            'nb_backlinks' => $validated['nb_backlinks'],
            'nb_orders' => $validated['nb_orders'],
            'nb_cart' => $validated['nb_cart'],
        ]);

        return redirect()->route('rapports.index');
    }

    // Display the specified resource
    public function show($id)
    {
        $rapport = Rapport::findOrFail($id);
        return view('rapports.show', compact('rapport'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $rapport = Rapport::findOrFail($id);
        $projets = Projet::all();
        return view('rapports.edit', compact('rapport', 'projets'));
    }


    // Update method
    public function update(Request $request, $id)
    {
        // Ensure that the periode is being correctly parsed as a date object
        $periode = Carbon::parse($request->periode . '-01')->format('Y-m-d');

        $validated = $request->validate([
            'id_projet' => 'required|exists:projets,id_projet',
            'nom_rapport' => 'required|string|max:255',
            'periode' => 'required|date',
            'total_clicks' => 'required|integer',
            'total_impressions' => 'required|integer',
            'avg_ctr' => 'required|numeric',
            'avg_position' => 'required|numeric',
            'nb_sessions' => 'required|integer',
            'nb_active_users' => 'required|integer',
            'nb_new_users' => 'required|integer',
            'page_speed' => 'required|numeric',
            'performance' => 'required|numeric',
            'accessibility' => 'required|numeric',
            'best_practices' => 'required|numeric',
            'seo' => 'required|numeric',
            'nb_backlinks' => 'required|integer',
            'nb_orders' => 'required|integer',
            'nb_cart' => 'required|integer',
        ]);

        // Find and update the rapport
        $rapport = Rapport::findOrFail($id);
        $rapport->update([
            'id_projet' => $validated['id_projet'],
            'nom_rapport' => $validated['nom_rapport'],
            'periode' => $periode,  // Update with the valid date
            'total_clicks' => $validated['total_clicks'],
            'total_impressions' => $validated['total_impressions'],
            'avg_ctr' => $validated['avg_ctr'],
            'avg_position' => $validated['avg_position'],
            'nb_sessions' => $validated['nb_sessions'],
            'nb_active_users' => $validated['nb_active_users'],
            'nb_new_users' => $validated['nb_new_users'],
            'page_speed' => $validated['page_speed'],
            'performance' => $validated['performance'],
            'accessibility' => $validated['accessibility'],
            'best_practices' => $validated['best_practices'],
            'seo' => $validated['seo'],
            'nb_backlinks' => $validated['nb_backlinks'],
            'nb_orders' => $validated['nb_orders'],
            'nb_cart' => $validated['nb_cart'],
        ]);

        return redirect()->route('rapports.index');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $rapport = Rapport::findOrFail($id);
        $rapport->delete();

        return redirect()->route('rapports.index');
    }
}
