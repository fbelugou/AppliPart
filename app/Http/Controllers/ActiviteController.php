<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ActiviteRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActiviteController extends Controller
{
    protected $activiteRepository;

    public function __construct(activiteRepository $activiteRepository)
    {
        $this->activiteRepository = $activiteRepository;
    }

    public function listerActivites()
    {
        $activites = $this->activiteRepository->getActivites();

        return view('ListeActivites', compact('activites'));
    }

    public function ajouterActivites()
    {
        return view('AjoutActivite');
    }

    public function enregistrer(ActiviteCreateRequest $request)
    {
        $activite = $this->activiteRepository->store($request->all());

        return redirect('activite')->withOk("L'activite " . $activite->name . " a été créé.");
    }

    public function afficher($id)
    {
        $activite = $this->activiteRepository->getById($id);

        return view('FicheActivite',  compact('activite'));
    }

    public function modifier($id)
    {
        $activite = $this->activiteRepository->getById($id);

        return view('edit',  compact('activite'));
    }

    public function mettreAJour(ActiviteUpdateRequest $request, $id)
    {
        $this->activiteRepository->update($id, $request->all());

        return redirect('activite')->withOk("L'activite " . $request->input('name') . " a été modifié.");
    }

    public function supprimer($id)
    {
        $this->activiteRepository->destroy($id);

        return back();
    }
}
