<?php

use Google\Client;
use Google\Service\AnalyticsReporting;

class GoogleAnalyticsController extends Controller
{
    public function getAnalyticsData()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(AnalyticsReporting::ANALYTICS_READONLY);

        $analytics = new AnalyticsReporting($client);
        $viewId = 'your_view_id';

        $request = new AnalyticsReporting\ReportRequest();
        $request->setViewId($viewId);
        $request->setDateRanges([new AnalyticsReporting\DateRange('7daysAgo', 'today')]);
        $request->setMetrics([
            new AnalyticsReporting\Metric('ga:sessions'),
            new AnalyticsReporting\Metric('ga:users'),
            new AnalyticsReporting\Metric('ga:newUsers'),
        ]);
        $request->setDimensions([new AnalyticsReporting\Dimension('ga:pagePath')]);

        $response = $analytics->reports->batchGet(['reportRequests' => [$request]]);

        // Extract data from response
        $sessions = 0;
        $activeUsers = 0;
        $newUsers = 0;
        $topPages = [];

        foreach ($response->getReports() as $report) {
            foreach ($report->getData()->getRows() as $row) {
                $sessions += $row->getMetrics()[0]->getValues()[0];
                $activeUsers += $row->getMetrics()[0]->getValues()[1];
                $newUsers += $row->getMetrics()[0]->getValues()[2];
                $topPages[] = $row->getDimensions()[0];
            }
        }

        return view('analytics.index', compact('sessions', 'activeUsers', 'newUsers', 'topPages'));
    }
}
