<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ApiController extends Controller
{
    public function index()
    {
        $response = Http::get('https://hajusrakendus.ta22maarma.itmajakas.ee/api/records');
        $records = $response->json();

        return view('api', ['records' => $records]);
    }
}
