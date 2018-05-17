<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\InterlocuteurRepository;
use App\Repositories\EntrepriseRepository;

use App\Http\Requests\InterlocuteurCreateRequest;
use App\Http\Requests\InterlocuteurUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InterlocuteurController extends Controller
{
    protected $interlocuteurRepository;
    protected $entrepriseRepository;

    public function __construct(interlocuteurRepository $interlocuteurRepository,entrepriseRepository $entrepriseRepository)
    {
        $this->interlocuteurRepository = $interlocuteurRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function lister()
    {
        $interlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();

        return view('Interlocuteur\ListeInterlocuteurs', compact('interlocuteurs'));
    }

    public function ajouter()
    {
        $entreprises[0]='Choisissez un interlocuteur';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        return view('Interlocuteur\AjoutInterlocuteur',compact('entreprises'));
    }

    public function enregistrer(InterlocuteurCreateRequest $request)
    {
        $interlocuteur = $this->interlocuteurRepository->store($request->all());

        return redirect()->route('FicheInterlocuteur',['id' => $interlocuteur->id]);
    }

    public function afficher($id)
    {
        $interlocuteur = $this->interlocuteurRepository->getById($id);

        return view('Interlocuteur\FicheInterlocuteur',  compact('interlocuteur'));
    }

    public function modifier($id)
    {
        $entreprises[0]='Choisissez un interlocuteur';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        $interlocuteur = $this->interlocuteurRepository->getById($id);

        return view('Interlocuteur\ModifierInterlocuteur',  compact('interlocuteur','entreprises'));
    }

    public function mettreAJour(InterlocuteurUpdateRequest $request, $id)
    {
        $this->interlocuteurRepository->update($id, $request->all());

        return redirect()->route('FicheInterlocuteur',['id' => $id]);
    }

    public function supprimer($id)
    {
        $this->interlocuteurRepository->destroy($id);

        return redirect()->route('Interlocuteurs');
    }

    public function listeMail()
    {
        $mails = $this->interlocuteurRepository->getInterlocuteursMail();

        return view('Interlocuteur\ListeMail',compact('mails'));
    }
}
