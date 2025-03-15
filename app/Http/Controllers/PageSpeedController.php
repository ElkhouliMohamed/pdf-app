<?php

use Google\Client;

class PageSpeedController extends Controller
{
    public function getPageSpeedData($url ,$apiKey)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope('https://www.googleapis.com/auth/webmasters.readonly');

        $client->setDeveloperKey($apiKey);
        $service = new \Google\Service\PagespeedInsights($client);

        // Get the performance score data
        $response = $service->pagespeedapi->runpagespeed($url);
        $performance = $response->getLighthouseResult()->getCategories()->getPerformance()->getScore();
        $accessibility = $response->getLighthouseResult()->getCategories()->getAccessibility()->getScore();
        $bestPractices = $response->getLighthouseResult()->getCategories()->getBestPractices()->getScore();
        $seo = $response->getLighthouseResult()->getCategories()->getSeo()->getScore();

        return view('pagespeed.index', compact('performance', 'accessibility', 'bestPractices', 'seo'));
    }
}
