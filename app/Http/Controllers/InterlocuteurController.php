<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\InterlocuteurRepository;
use App\Repositories\EntrepriseRepository;

use App\Http\Requests\InterlocuteurCreateRequest;
use App\Http\Requests\InterlocuteurUpdateRequest;
use App\Http\Requests\InterlocuteurSearchRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Mail\AjoutBD;
use Illuminate\Support\Facades\Mail;

class InterlocuteurController extends Controller
{
    protected $interlocuteurRepository;
    protected $entrepriseRepository;

    public function __construct(interlocuteurRepository $interlocuteurRepository,entrepriseRepository $entrepriseRepository)
    {
        //Recuperation des repository nécéssaires
        $this->interlocuteurRepository = $interlocuteurRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    //Fonction de listage des interlocuteurs
    public function lister()
    {
        //Récupération de tous les interlocuteurs
        $interlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();
        //Envoi des interlocuteurs à la vue ListeInterlocuteurs et affichage de la vue
        return view('Interlocuteur/ListeInterlocuteurs', compact('interlocuteurs'));
    }

    //Fonction d'ajout d'un interlocuteur
    public function ajouter()
    {
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        /*foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }*/
        //Envoi des entreprises à la vue formulaire AjoutInterlocuteur et affichage de la vue
        return view('Interlocuteur/AjoutInterlocuteur',compact('entreprises'));
    }

    //Fonction d'enregistrement en base de données d'un interlocuteur avec des données d'un formulaire
    public function enregistrer(InterlocuteurCreateRequest $request)
    {
        //Enregistrement en base de l'interlocuteur
        $interlocuteur = $this->interlocuteurRepository->store($request->all());
        //Envoi d'un mail pour prévenir l'utilisateur de son ajour à la base (si l'adresse n'est pas nulle)
        //Mail modifiable : ressources/views/mail.blade.php
        //Sujet et envoyeur du mail modifiable : app/mail/ajoutBD.php
        /*if(!is_null($interlocuteur->mail)){
            Mail::to($interlocuteur->mail, $interlocuteur->prenom.' '.$interlocuteur->nom)
                  ->send(new AjoutBD($interlocuteur));
        }*/
        //Redirection à l'action FicheInterlocuteur du controller avec l'id de l'interlocuteur
        return redirect()->route('FicheInterlocuteur',['id' => $interlocuteur->id]);
    }

    //Fonction d'affichage d'un interlocuteur
    public function afficher($id)
    {
        //récupération de l'interlocuteur via l'id
        $interlocuteur = $this->interlocuteurRepository->getById($id);
        //Envoir de l'interlocuteur à la vue FicheInterlocuteur et affichage de la vue
        return view('Interlocuteur/FicheInterlocuteur',  compact('interlocuteur'));
    }

    //Fonction d'affichage de formulaire de modification d'un interlocuteur
    public function modifier($id)
    {
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Récupération d'un interlocuteur
        $interlocuteur = $this->interlocuteurRepository->getById($id);
        //Récupération du type actuel pour la liste déroulante
        switch ($interlocuteur->type) {
          case 'Opérationel':
            $nbType=1;
            break;
          case 'Ressources Humaines':
            $nbType=2;
            break;
          case 'Mission Handicap':
            $nbType=3;
            break;
        }
        //Envoi de l'interlocuteur, des entreprises et du type de fonction à la vue ModifierInterlocuteur et affichage de la vue
        return view('Interlocuteur/ModifierInterlocuteur',  compact('interlocuteur','entreprises','nbType'));
    }

    //Fonction de modification d'un interlocuteur en base de données
    public function mettreAJour(InterlocuteurUpdateRequest $request, $id)
    {
        //Appel à la méthode du répository pour modifier l'interlocuteur
        $this->interlocuteurRepository->update($id, $request->all());
        //redirection à l'action FicheInterlocuteur du controlleur avec l'id de l'interlocuteur
        return redirect()->route('FicheInterlocuteur',['id' => $id]);
    }

    //Fonction de suppression d'un interlocuteur
    public function supprimer($id)
    {
        //Récupération de l'interlocuteur
        $interlocuteur = $this->interlocuteurRepository->getById($id);
        //Suppression du lien etre l'interlocuteur et les entreprises
        $interlocuteur->entreprises()->detach();
        //Suppression de l'interlocuteur
        $this->interlocuteurRepository->destroy($id);
        //Redirection à la liste des interlocuteurs
        return redirect()->route('Interlocuteurs');
    }

    //Fonction de génération d'une liste de mails
    public function listeMail()
    {
        //Récupération des mails dans un tableau à partir d'objets en session
        $mails = $this->interlocuteurRepository->getInterlocuteursMail(Session::get('interlocuteurs'));
        //Envoi de la liste de mails à la vue ListeMail et affichage de la vue
        return view('ListeMail',compact('mails'));
    }

    //Fonction de recherche de groupes par rapport au nom
    public function recherche(InterlocuteurSearchRequest $request)
    {
        //Appel à la méthode du répository pour chercher un interlocuteur
        $interlocuteurs = $this->interlocuteurRepository->search($request->all());
        //Envoi des résultats à la vue RechercheInterlocuteurs et affichage de la vue
        return view('Interlocuteur/RechercheInterlocuteurs',compact('interlocuteurs'));
    }
}
