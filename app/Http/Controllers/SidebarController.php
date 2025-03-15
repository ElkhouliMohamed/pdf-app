<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    /**
     * Show the sidebar with the list of projets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all projets
        $projets = Projet::all();

        // Pass the data to the sidebar view
        return view('layouts.side', compact('projets'));
    }
}
