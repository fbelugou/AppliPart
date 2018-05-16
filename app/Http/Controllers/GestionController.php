<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\EntrepriseRequest;
use App\Repositories\EntrepriseRepository;

class GestionController extends Controller
{
    public function index()
    {
        return view('Accueil');
    }
}
