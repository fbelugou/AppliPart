<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\InterlocuteurRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InterlocuteurController extends Controller
{
    protected $interlocuteurRepository;

    public function __construct(interlocuteurRepository $interlocuteurRepository)
    {
        $this->interlocuteurRepository = $interlocuteurRepository;
    }

    public function listerInterlocuteurs()
    {
        $interlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();

        return view('ListeInterlocuteurs', compact('interlocuteurs'));
    }

    public function ajouterInterlocuteurs()
    {
        return view('AjoutInterlocuteur');
    }

    public function enregistrer(InterlocuteurCreateRequest $request)
    {
        $interlocuteur = $this->interlocuteurRepository->store($request->all());

        return redirect('interlocuteur')->withOk("L'interlocuteur " . $interlocuteur->name . " a été créé.");
    }

    public function afficher($id)
    {
        $interlocuteur = $this->interlocuteurRepository->getById($id);

        return view('FicheInterlocuteur',  compact('interlocuteur'));
    }

    public function modifier($id)
    {
        $interlocuteur = $this->interlocuteurRepository->getById($id);

        return view('edit',  compact('interlocuteur'));
    }

    public function mettreAJour(InterlocuteurUpdateRequest $request, $id)
    {
        $this->interlocuteurRepository->update($id, $request->all());

        return redirect('interlocuteur')->withOk("L'interlocuteur " . $request->input('name') . " a été modifié.");
    }

    public function supprimer($id)
    {
        $this->interlocuteurRepository->destroy($id);

        return back();
    }
}
