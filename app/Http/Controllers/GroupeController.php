<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\GroupeRepository;
use App\Repositories\EntrepriseRepository;

use App\Http\Requests\GroupeCreateRequest;
use App\Http\Requests\GroupeUpdateRequest;
use App\Http\Requests\GroupeSearchRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupeController extends Controller
{
    protected $groupeRepository;
    protected $entrepriseRepository;

    public function __construct(groupeRepository $groupeRepository,EntrepriseRepository $entrepriseRepository)
    {
        //Recuperation des repository nécéssaires
        $this->groupeRepository = $groupeRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    //Fonction de listage des groupes
    public function lister()
    {
        //Récupération de tous les groupes
        $groupes = $this->groupeRepository->getGroupes();
        //Envoi des groupes à la vue ListeGroupes et affichage de la vue
        return view('Groupe/ListeGroupes', compact('groupes'));
    }

    //Fonction d'ajout d'un groupe
    public function ajouter()
    {
        //Affichage de le vue de formulaire d'ajout de groupe AjoutGroupe
        return view('Groupe/AjoutGroupe');
    }

    //Fonction d'enregistrement en base de données d'un groupe avec des données d'un formulaire
    public function enregistrer(GroupeCreateRequest $request)
    {
        //Enregistrement en base du groupe
        $groupe = $this->groupeRepository->store($request->all());
        //Redirection à l'action FicheGroupe du controlleur avec l'id du groupe
        return redirect()->route('FicheGroupe',['id' => $groupe->id]);
    }

    //Fonction d'affichage d'un groupe
    public function afficher($id)
    {
        //Récupération du groupe via l'id
        $groupe = $this->groupeRepository->getById($id);
        //Envoi du groupe à la vue FicheGroupe et affichage de la vue
        return view('Groupe/FicheGroupe',  compact('groupe'));
    }

    //Fonction d'affichage de formulaire de modification d'un groupe
    public function modifier($id)
    {
        //Récupération du groupe via l'id
        $groupe = $this->groupeRepository->getById($id);
        //Envoi du groupe à la vue ModifierGroupe et affichage de la vue
        return view('Groupe/ModifierGroupe',  compact('groupe'));
    }

    //Fonction de modification d'un groupe en base de données
    public function mettreAJour(GroupeUpdateRequest $request, $id)
    {
        //Appel à la méthode du répository pour modifier le groupe
        $this->groupeRepository->update($id, $request->all());
        //redirection à l'action FicheGroupe du controlleur avec l'id du groupe
        return redirect()->route('FicheGroupe',['id' => $id]);
    }

    //Fonction de suppression d'un groupe
    public function supprimer($id)
    {
        //Récupération de l'entreprise
        $groupe = $this->groupeRepository->getById($id);
        //Suppression des entreprises du groupe
        foreach($groupe->entreprises as $entreprise){
            $this->EntrepriseRepository->destroy($entreprise->id);
        }
        //Suppression du groupe
        $this->groupeRepository->destroy($id);
        //Redirection à la liste des groupes
        return redirect()->route('Groupes');
    }

    //Fonction de recherche de groupes par rapport au nom
    public function recherche(GroupeSearchRequest $request)
    {
        //Appel à la méthode du repository pour chercher un groupe
        $groupes = $this->groupeRepository->search($request->all());
        //Envoi des résultats à la vue RechercheGroupes et affichage de la vue
        return view('Groupe/RechercheGroupes',  compact('groupes'));
    }
}
