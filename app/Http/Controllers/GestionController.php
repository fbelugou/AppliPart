<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class GestionController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
