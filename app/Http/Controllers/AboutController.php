<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');

        return view('about.index', compact('settings'));
    }
}
