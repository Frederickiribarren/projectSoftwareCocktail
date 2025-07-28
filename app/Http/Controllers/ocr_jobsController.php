<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ocr_jobsController extends Controller
{
    public function index()
    {
        $ocr_jobs = ocr_jobs::all();
        return view('ocr_jobs.index', compact('ocr_jobs'));
    }
}
