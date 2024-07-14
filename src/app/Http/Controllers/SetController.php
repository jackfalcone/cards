<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SetController extends Controller
{
    public function index()
    {
        $sets = Set::all();

        return Inertia::render('Index', ['sets' => $sets]);
    }
}
