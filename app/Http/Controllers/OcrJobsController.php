<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\ocr_jobs;

class ocr_jobsController extends Controller
{
    public function index()
    {
        $ocr_jobs = ocr_jobs::all();
        return view('ocr_jobs.index', compact('ocr_jobs'));
    }
    public function create()
    {
        return view('ocr_jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        ocr_jobs::create($request->all());

        return redirect()->route('ocr_jobs.index')
                         ->with('success', 'OCR Job created successfully.');
    }

    public function show($id)
    {
        $ocr_job = ocr_jobs::findOrFail($id);
        return view('ocr_jobs.show', compact('ocr_job'));
    }

    public function edit($id)
    {
        $ocr_job = ocr_jobs::findOrFail($id);
        return view('ocr_jobs.edit', compact('ocr_job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $ocr_job = ocr_jobs::findOrFail($id);
        $ocr_job->update($request->all());

        return redirect()->route('ocr_jobs.index')
                         ->with('success', 'OCR Job updated successfully.');
    }

    public function destroy($id)
    {
        $ocr_job = ocr_jobs::findOrFail($id);
        $ocr_job->delete();

        return redirect()->route('ocr_jobs.index')
                         ->with('success', 'OCR Job deleted successfully.');
    }
}
