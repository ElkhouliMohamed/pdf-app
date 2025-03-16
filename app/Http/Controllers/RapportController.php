<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;
use Carbon\Carbon;
use App\Models\Rapport;
use Illuminate\Support\Facades\Cache;
use App\Models\Projet;
use App\Models\TopKeyword;
use App\Models\TopPage;
use App\Models\TopSessionPage;
use App\Models\ErrorPage;
use App\Models\Backlink;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    //! start
    //! start
    public function pdf_rapport($rapport_id)
    {
        try {
            $rapport = Rapport::with(['projet', 'topKeywords', 'topPages', 'topSessionPages'])
                ->findOrFail($rapport_id);

            $projet = $rapport->projet;

            // Fetch the previous month's data
            $previousMonth = Rapport::with(['topKeywords', 'topPages', 'topSessionPages'])
                ->where('id_projet', $rapport->id_projet)
                ->whereMonth('periode', Carbon::parse($rapport->periode)->subMonth()->month)
                ->whereYear('periode', Carbon::parse($rapport->periode)->subMonth()->year)
                ->first();

            // Calculate percentage changes for key metrics
            $percentageChanges = $this->calculateAllPercentageChanges($rapport, $previousMonth);

            // Fetch top keywords and compare with last month's data
            $topKeywords = $rapport->topKeywords()
                ->orderBy('nombre_requetes', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($keyword) use ($previousMonth) {
                    $prevValue = optional($previousMonth?->topKeywords->firstWhere('keyword', $keyword->keyword))->nombre_requetes ?? 0;

                    $keyword->previous_requetes = $prevValue;
                    $keyword->evolution = $this->calculatePercentageChange($keyword->nombre_requetes, $prevValue);

                    return $keyword;
                });


            // Fetch top pages and session pages
            $topPages = $rapport->topPages()->orderBy('nombre_visites', 'desc')->limit(10)->get();
            $topSessionPages = $rapport->topSessionPages()->orderBy('duree_moyenne', 'desc')->limit(10)->get();

            // Handle project image path
            $imagePath = public_path('storage/images/' . ($projet->image_path ?? 'default.jpg'));
            Log::info('Project Image Path from DB: ' . ($projet->image_path ?? 'Not set, using default.jpg'));
            Log::info('Full Image Path: ' . $imagePath);
            if (!file_exists($imagePath)) {
                Log::warning('Image file does not exist at: ' . $imagePath);
            } else {
                Log::info('Image file exists: Yes');
                Log::info('Image file readable: ' . (is_readable($imagePath) ? 'Yes' : 'No'));
                Log::info('Image file size: ' . filesize($imagePath) . ' bytes');
            }

            // Generate the PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('rapports.pdf', compact(
                'rapport',
                'projet',
                'previousMonth',
                'topKeywords',
                'topPages',
                'topSessionPages',
                'percentageChanges'
            ))->setPaper('a4', 'portrait');

            return $pdf->download('rapport_' . $rapport->nom_rapport . '.pdf');
        } catch (\Exception $e) {
            Log::error('PDF Generation Failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Erreur lors de la génération du PDF', 'details' => $e->getMessage()], 500);
        }
    }

    private function calculateAllPercentageChanges($current, $previous)
    {
        $percentageChanges = [];
        $fieldsToCompare = [
            'total_clicks',
            'total_impressions',
            'avg_ctr',
            'avg_position',
            'nb_sessions',
            'nb_active_users',
            'nb_new_users',
            'bounce_rate'
        ];

        if (!$previous) {
            return array_fill_keys($fieldsToCompare, 'N/A');
        }

        foreach ($fieldsToCompare as $field) {
            $percentageChanges[$field] = $this->calculatePercentageChange(
                $current->$field ?? 0,
                $previous->$field ?? 0
            );
        }

        return $percentageChanges;
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }
    //!  end


    //!   for rapports of a project
    public function viewRapports($projet_id)
        {
                // Find the project using the ID
                $projet = Projet::findOrFail($projet_id);

                // Fetch reports related to this project
                $rapports = Rapport::where('id_projet', $projet_id)->get();
                // Fetch Top Keywords (if you have a relationship)
                $top_keywords = TopKeyword::where('id_projet', $projet_id)->get();

                // Fetch Top Session Pages (if you have a relationship)
                $top_session_pages = TopSessionPage::where('id_projet', $projet_id)->get();

                // Return the view with the reports, project details, top keywords, and top session pages
                return view('projets.rapports', compact('projet', 'rapports', 'top_keywords', 'top_session_pages'));
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
    // Current query could be simplified using Eloquent relationships
    public function show($id)
    {
        // Fetch current report with related models
        $rapport = Rapport::with(['projet', 'topKeywords', 'topSessionPages'])
            ->findOrFail($id);

        // Calculate the previous month’s date and fetch the report for that month
        $previousMonthDate = (clone $rapport->periode)->subMonth();
        $previousMonth = Rapport::where('id_projet', $rapport->id_projet)
            ->whereMonth('periode', $previousMonthDate->month)
            ->whereYear('periode', $previousMonthDate->year)
            ->first();

        // If no previous month data, set it to an empty object
        $previousMonth = $previousMonth ?? new Rapport();

        // Pass data to the view
        return view('rapports.show', [
            'rapport' => $rapport,
            'previousMonth' => $previousMonth,
            'projet' => $rapport->projet,
            'top_keywords' => $rapport->topKeywords,
            'top_session_pages' => $rapport->topSessionPages
        ]);
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
