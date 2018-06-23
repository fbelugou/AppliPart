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
        //Recuperation des repository nécéssaires
        $this->actionRepository = $actionRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    //Fonction de listage des actions
    public function lister()
    {
        //Récupération de toutes les actions
        $actions = $this->actionRepository->getActions();
        //Envoi des actions à la vue ListeActions et affichage de la vue
        return view('Action/ListeActions', compact('actions'));
    }

    //Fonction d'ajout d'une action
    public function ajouter()
    {
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Envoi du tableau pour la liste déroulante à la vue AjoutAction et affichage de la vue
        return view('Action/AjoutAction',compact('entreprises'));
    }

    //Fonction d'ajout d'une action avec l'entreprise déjà renseignée
    public function ajouterEnt($entreprise_id)
    {
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Envoi du tableau pour la liste déroulante à la vue AjoutAction et affichage de la vue
        return view('Action/AjoutAction',compact('entreprises','entreprise_id'));
    }

    //Fonction d'enregistrement en base de données d'une action avec des données d'un formulaire
    public function enregistrer(ActionCreateRequest $request)
    {
        //Enregistrement en base de l'action
        $action = $this->actionRepository->store($request->all());
        //Redirection à l'action FicheAction du controlleur avec l'id de l'action
        return redirect()->route('FicheAction',['id' => $action->id]);
    }

    //Fonction d'affichage d'une action
    public function afficher($id)
    {
        //Récupération de l'action via l'id
        $action = $this->actionRepository->getById($id);
        //Envoi de l'action à la vue FicheAction et affichage de la vue
        return view('Action/FicheAction',  compact('action'));
    }

    //Fonction d'affichage de formulaire de modification d'une action
    public function modifier($id)
    {
        //Récupération d'une action
        $action = $this->actionRepository->getById($id);
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Envoi de l'action et des entreprises à la vue ModifierAction et affichage de la vue
        return view('Action/ModifierAction',  compact('action','entreprises'));
    }

    //Fonction de modification d'une action en base de données
    public function mettreAJour(ActionUpdateRequest $request, $id)
    {
        //Appel à la méthode du répository pour modifier l'action
        $this->actionRepository->update($id, $request->all());
        //redirection à l'action FicheAction du controlleur avec l'id de l'action
        return redirect()->route('FicheAction',['id' => $id]);
    }

    //Fonction de suppression d'une action
    public function supprimer($id)
    {
        //Appel à la méthode du repository pour supprimer l'objet de la base de données
        $this->actionRepository->destroy($id);
        //Redirection à la liste des actions
        return redirect()->route('Actions');
    }

    //Fonction de recherche d'entreprises par rapport à une action
    public function recherche(ActionSearchRequest $request)
    {
        //Récupération de l'action choisie dans la liste déroulante
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
        //Récupération des actions correspondantes à la nature donnée
        $actions = $this->actionRepository->search($nature);
        //Enregistrement en variable de la limitation des actions au partenaires réguliers
        $partReg=$request['limiteEntAct'];
        //Envoi des actions du libellé de la nature et de la limitation à la vue RechercheActions et affichage de la vue
        return view('Action/RechercheActions',  compact('actions','nature','partReg'));
    }
}
