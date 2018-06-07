<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ActionRepository;
use App\Repositories\EntrepriseRepository;

use App\Http\Requests\ActionCreateRequest;
use App\Http\Requests\ActionUpdateRequest;
use App\Http\Requests\ActionSearchRequest;

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

    public function recherche(ActionSearchRequest $request)
    {
        switch ($request['action']) {
          case 1:
            $nature='Stage';
            break;
          case 2:
            $nature='Alternance';
            break;
          case 3:
            $nature='JobDating';
            break;
          case 4:
            $nature='Visite d\'entreprise';
            break;
          case 5:
            $nature='Taxe d\'apprentissage';
            break;
          case 6:
            $nature='Jury d\'examen';
            break;
          case 7:
            $nature='Parrainage';
            break;
          case 8:
            $nature='Intervention technique';
            break;
          case 9:
            $nature='Formation stagiaire';
            break;
          case 10:
            $nature='Formation formateur';
            break;
          case 11:
            $nature='Embauche';
            break;
          case 12:
            $nature='Don de materiel';
            break;
          case 13:
          $nature='Autres%';
          break;
        }

        $actions = $this->actionRepository->search($nature);
        $partReg=$request['limiteEntAct'];

        return view('Action\RechercheActions',  compact('actions','nature','partReg'));
    }
}
