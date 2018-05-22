<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ActionRepository;
use App\Repositories\EntrepriseRepository;

use App\Http\Requests\ActionCreateRequest;
use App\Http\Requests\ActionUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    protected $actionRepository;
    protected $entrepriseRepository;

    public function __construct(actionRepository $actionRepository,entrepriseRepository $entrepriseRepository)
    {
        $this->actionRepository = $actionRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function lister()
    {
        $actions = $this->actionRepository->getActions();

        return view('Action\ListeActions', compact('actions'));
    }

    public function ajouter()
    {
        $entreprises[0]='Choisissez une entreprise';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        return view('Action\AjoutAction',compact('entreprises'));
    }

    public function ajouterEnt($entreprise_id)
    {
        $entreprises[0]='Choisissez une entreprise';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        return view('Action\AjoutAction',compact('entreprises','entreprise_id'));
    }

    public function enregistrer(ActionCreateRequest $request)
    {
        $action = $this->actionRepository->store($request->all());

        return redirect()->route('FicheAction',['id' => $action->id]);
    }

    public function afficher($id)
    {
        $action = $this->actionRepository->getById($id);

        return view('Action\FicheAction',  compact('action'));
    }

    public function modifier($id)
    {
        $action = $this->actionRepository->getById($id);
        $entreprises[0]='Choisissez une entreprise';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        return view('Action\ModifierAction',  compact('action','entreprises'));
    }

    public function mettreAJour(ActionUpdateRequest $request, $id)
    {
        $this->actionRepository->update($id, $request->all());

        return redirect()->route('FicheAction',['id' => $id]);
    }

    public function supprimer($id)
    {
        $this->actionRepository->destroy($id);

        return redirect()->route('Actions');
    }
}
