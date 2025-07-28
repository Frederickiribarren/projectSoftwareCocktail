<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pageMain');
});

Route::get('/login', function () {
    return view('components.login');
});