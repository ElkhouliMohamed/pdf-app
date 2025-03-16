<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ChartController extends Controller
{
    // Show the chart for a given report
    public function show($id)
    {
        $rapport = Rapport::with(['topKeywords', 'topSessionPages'])
            ->findOrFail($id);

        $previousMonthDate = (clone $rapport->periode)->subMonth();
        $previousMonth = Rapport::where('id_projet', $rapport->id_projet)
            ->whereMonth('periode', $previousMonthDate->month)
            ->whereYear('periode', $previousMonthDate->year)
            ->first();

        $metrics = $this->getMetrics($rapport, $previousMonth);

        // Add chart data
        $clicksData = $this->prepareChartData(
            'Total Clicks',
            $rapport->total_clicks,
            $previousMonth ? $previousMonth->total_clicks : 0
        );
        $impressionsData = $this->prepareChartData(
            'Total Impressions',
            $rapport->total_impressions,
            $previousMonth ? $previousMonth->total_impressions : 0
        );
        $ctrData = $this->prepareChartData(
            'Average CTR (%)',
            $rapport->avg_ctr,
            $previousMonth ? $previousMonth->avg_ctr : 0,
            true
        );

        return view('charts.show', [
            'rapport' => $rapport,
            'previousMonth' => $previousMonth,
            'metrics' => $metrics,
            'topKeywords' => $rapport->topKeywords,
            'clicksData' => $clicksData,
            'impressionsData' => $impressionsData,
            'ctrData' => $ctrData
        ]);
    }


    public function chart_data($rapport_id)
    {
        try {
            // Fetch the rapport and related data
            $rapport = Rapport::with(['projet', 'topKeywords', 'topPages', 'topSessionPages'])
                ->findOrFail($rapport_id);

            $previousMonth = Rapport::with(['topKeywords', 'topPages', 'topSessionPages'])
                ->where('id_projet', $rapport->id_projet)
                ->whereMonth('periode', Carbon::parse($rapport->periode)->subMonth()->month)
                ->whereYear('periode', Carbon::parse($rapport->periode)->subMonth()->year)
                ->first();

            // Fetch all the metrics using a generalized method
            $metrics = $this->getMetrics($rapport, $previousMonth);

            // Prepare chart data for Total Clicks vs Impressions
            $clicksData = $this->prepareChartData('Total Clicks', $rapport->total_clicks, $previousMonth->total_clicks);
            $impressionsData = $this->prepareChartData('Total Impressions', $rapport->total_impressions, $previousMonth->total_impressions);

            // Prepare chart data for Average CTR
            $ctrData = $this->prepareChartData('Average CTR (%)', $rapport->avg_ctr, $previousMonth->avg_ctr, true);

            // Return view with data
            return view('charts.show', [
                'metrics' => $metrics,
                'topKeywords' => $rapport->topKeywords,
                'topPages' => $rapport->topPages,
                'topSessionPages' => $rapport->topSessionPages,
                'clicksData' => $clicksData,
                'impressionsData' => $impressionsData,
                'ctrData' => $ctrData
            ]);
        } catch (\Exception $e) {
            Log::error('Chart Data Fetch Failed: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            return view('errors.general', ['error' => 'Erreur lors de la récupération des données du graphique', 'details' => $e->getMessage()]);
        }
    }



    /**
     * Generalized method to get all metrics data.
     *
     * @param Rapport $rapport
     * @param Rapport|null $previousMonth
     * @return array
     */
    private function getMetrics($rapport, $previousMonth)
    {
        $metricsFields = [
            'total_clicks',
            'total_impressions',
            'avg_ctr',
            'avg_position',
            'nb_sessions',
            'nb_active_users',
            'page_speed',
            'performance',
            'accessibility',
            'best_practices',
            'seo'
        ];

        $metrics = [];
        foreach ($metricsFields as $field) {
            $metrics[$field] = $this->getChartData($rapport, $previousMonth, $field);
        }

        return $metrics;
    }

    /**
     * Prepares the chart data for a given metric.
     *
     * @param Rapport $rapport
     * @param Rapport|null $previousMonth
     * @param string $field
     * @return array
     */
    private function getChartData($rapport, $previousMonth, $field)
    {
        return [
            'current' => $rapport->$field,
            'previous' => $previousMonth ? $previousMonth->$field : 0
        ];
    }

    /**
     * Prepares the data for a specific chart type.
     *
     * @param string $label
     * @param float $currentValue
     * @param float|null $previousValue
     * @param bool $isLineChart
     * @return array
     */
    private function prepareChartData($label, $currentValue, $previousValue, $isLineChart = false)
    {
        $chartData = [
            'labels' => ['Current Month', 'Previous Month'],
            'datasets' => [
                [
                    'label' => $label,
                    'data' => [$currentValue, $previousValue ?? 0],
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];

        if ($isLineChart) {
            $chartData['datasets'][0]['fill'] = false;
            $chartData['datasets'][0]['borderColor'] = 'rgba(75, 192, 192, 1)';
        }

        return $chartData;
    }
}
