<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FiliereRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FiliereController extends Controller
{
    protected $filiereRepository;

    public function __construct(filiereRepository $filiereRepository)
    {
        $this->filiereRepository = $filiereRepository;
    }

    public function listerFilieres()
    {
        $filieres = $this->filiereRepository->getFilieres();

        return view('ListeFilieres', compact('filieres'));
    }

    public function ajouterFilieres()
    {
        return view('AjoutFiliere');
    }

    public function enregistrer(FiliereCreateRequest $request)
    {
        $filiere = $this->filiereRepository->store($request->all());

        return redirect('filiere')->withOk("La filiere " . $filiere->name . " a été créé.");
    }

    public function afficher($id)
    {
        $filiere = $this->filiereRepository->getById($id);

        return view('FicheFiliere',  compact('filiere'));
    }

    public function modifier($id)
    {
        $filiere = $this->filiereRepository->getById($id);

        return view('edit',  compact('filiere'));
    }

    public function mettreAJour(FiliereUpdateRequest $request, $id)
    {
        $this->filiereRepository->update($id, $request->all());

        return redirect('filiere')->withOk("La filiere " . $request->input('name') . " a été modifié.");
    }

    public function supprimer($id)
    {
        $this->filiereRepository->destroy($id);

        return back();
    }
}
