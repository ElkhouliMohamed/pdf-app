<!-- resources/views/top_keywords/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Top Keyword Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $topKeyword->keyword }}</h5>
                <p class="card-text"><strong>Clicks:</strong> {{ $topKeyword->nb_clicks }}</p>
                <p class="card-text"><strong>Impressions:</strong> {{ $topKeyword->nb_impressions }}</p>
                <p class="card-text"><strong>CTR:</strong> {{ $topKeyword->avg_ctr }}%</p>
                <p class="card-text"><strong>Avg. Position:</strong> {{ $topKeyword->avg_position }}</p>
                <p class="card-text"><strong>Project Assigned:</strong> {{ $topKeyword->rapport ? $topKeyword->rapport->nom_projet : 'Not assigned' }}</p>
            </div>
        </div>
    </div>
@endsection
