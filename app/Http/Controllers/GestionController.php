<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class GestionController extends Controller
{
    public function index()
    {
        return view('Accueil');
    }

    public function listerPartenaires()
    {
      
        return view('listeEntreprises',['entreprises' => $tabEnt]);
    }
}
