<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $jobs = Job::all();  // Retrieve all jobs
        return view('jobs.index', compact('jobs'));  // Return view with the jobs
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('jobs.create');  // Return form for creating a new job
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        Job::create($validated);  // Create the job

        return redirect()->route('jobs.index');  // Redirect back to the jobs list
    }

    // Display the specified resource
    public function show($id)
    {
        $job = Job::findOrFail($id);  // Find the job by its ID
        return view('jobs.show', compact('job'));  // Return the view to show the job
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $job = Job::findOrFail($id);  // Find the job
        return view('jobs.edit', compact('job'));  // Return view to edit the job
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $job = Job::findOrFail($id);  // Find the job
        $job->update($validated);  // Update the job

        return redirect()->route('jobs.index');  // Redirect back to the jobs list
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $job = Job::findOrFail($id);  // Find the job
        $job->delete();  // Delete the job

        return redirect()->route('jobs.index');  // Redirect back to the jobs list
    }
}
