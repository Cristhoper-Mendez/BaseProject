<?php

namespace App\Http\Controllers\Backend\ApiClima;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClimaController extends Controller
{
    public function index()
    {
        return view('backend.admin.apiClima.clima');
    }
}
