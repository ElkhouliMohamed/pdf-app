<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Webmasters;
use Illuminate\Http\Request;

class SearchConsoleController extends Controller
{
    // Show the form where the user can input the site URL
    public function showForm()
    {
        return view('searchconsole.form');
    }

    // Fetch data from Google Search Console
    public function fetchSearchConsoleData(Request $request)
    {
        $urlSite = $request->input('urlSite');
        return $this->getSearchConsoleData($urlSite);
    }

    // Method to fetch Search Console data
    public function getSearchConsoleData($urlSite)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Webmasters::WEBMASTERS_READONLY);

        $service = new Webmasters($client);
        $siteUrl = $urlSite;

        $request = new Webmasters\SearchAnalyticsQueryRequest();
        $request->setStartDate('2025-01-01');
        $request->setEndDate('2025-03-01');
        $request->setDimensions(['query']);

        try {
            $response = $service->searchanalytics->query($siteUrl, $request);
        } catch (\Google\Service\Exception $e) {
            return response()->json(['error' => 'Google Search Console API Error: ' . $e->getMessage()]);
        }

        $totalClicks = 0;
        $totalImpressions = 0;
        $totalCTR = 0;
        $avgPosition = 0;
        $topKeywords = [];

        if (count($response->getRows()) > 0) {
            foreach ($response->getRows() as $row) {
                $totalClicks += $row->getClicks();
                $totalImpressions += $row->getImpressions();
                $totalCTR += $row->getCtr();
                $avgPosition += $row->getPosition();

                $topKeywords[] = implode(', ', $row->getKeys());
            }

            $avgPosition /= count($response->getRows());
            $avgCTR = $totalCTR / count($response->getRows());
        } else {
            $avgPosition = 0;
            $avgCTR = 0;
        }

        return view('searchconsole.index', compact('totalClicks', 'totalImpressions', 'avgCTR', 'avgPosition', 'topKeywords'));
    }
}
