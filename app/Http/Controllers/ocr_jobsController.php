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

}
