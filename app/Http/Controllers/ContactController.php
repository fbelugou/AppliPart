<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\ContactRepository;
use App\Repositories\EntrepriseRepository;
use App\Repositories\InterlocuteurRepository;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    protected $contactRepository;
    protected $entrepriseRepository;
    protected $interlocuteurRepository;

    public function __construct(contactRepository $contactRepository,EntrepriseRepository $entrepriseRepository,InterlocuteurRepository $interlocuteurRepository)
    {
        //Recuperation des repository nécéssaires
        $this->contactRepository = $contactRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->interlocuteurRepository = $interlocuteurRepository;
    }

    //Fonction d'ajout d'un contact pour une entreprise donnée
    public function ajouter($entreprise_id)
    {
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Récupération des interlocuteurs de l'entreprise
        $tabInterlocuteurs=$this->interlocuteurRepository->getInterlocuteursByEntreprise($entreprise_id);
        //Si la liste est vide récupération de la liste complète des interlocuteurs
        if(empty($tabInterlocuteurs->first())){
            $interlocuteurs=$this->interlocuteurRepository->getInterlocuteurs();
        }
        //Mise en forme des objets interlocuteurs pour la liste déroulante
        foreach ($tabInterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->interlocuteur_id]=$interlocuteur->prenom.' '.$interlocuteur->nom;
        }
        //Envoi des tableau pour les listes déroulantes à la vue AjoutContact et affichage de la vue
        return view('Contact\AjoutContact',compact('entreprise_id','entreprises','interlocuteurs'));
    }

    //Fonction d'enregistrement en base de données d'un contact avec des données d'un formulaire
    public function enregistrer(ContactCreateRequest $request)
    {
        //Enregistrement en base du contact
        $contact = $this->contactRepository->store($request->all());
        //redirection à l'action FicheContact du controlleur avec l'id du contact
        return redirect()->route('FicheContact',['id' => $contact->id]);
    }

    //Fonction d'affichage d'un contact
    public function afficher($id)
    {
        //Récupération du contact via l'id
        $contact = $this->contactRepository->getById($id);
        //Récupération de l'entreprise via l'id dans l'objet contact
        $entreprise = $this->entrepriseRepository->getById($contact->entreprise_id);
        //Récupération de l'interlocuteur via l'id dans l'objet contact
        $interlocuteur = $this->interlocuteurRepository->getById($contact->interlocuteur_id);
        //Envoi du contact, de l'entreprise et de l'interlocteur à la vue FicheContact et affichage de la vue
        return view('Contact\FicheContact',  compact('contact','entreprise','interlocuteur'));
    }

    //Fonction d'affichage de formulaire de modification d'un contact
    public function modifier($id)
    {
        //Récupération d'un contact
        $contact = $this->contactRepository->getById($id);
        //récupération de l'id de l'entreprise
        $entreprise_id=$contact->entreprise_id;
        //Création de la liste des entreprises à afficher
        $entreprises[0]='Choisissez une entreprise';
        //Récupération des entreprises
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        //Mise en forme des objets entreprise pour la liste déroulante
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        //Récupération des interlocuteurs de l'entreprise
        $tabInterlocuteurs=$this->interlocuteurRepository->getInterlocuteursByEntreprise($entreprise_id);
        //Mise en forme des objets interlocuteur pour la liste déroulante
        foreach ($tabInterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom.' '.$interlocuteur->nom;
        }
        //Envoi du coontact, des entreprises, des interlocuteurs et l'id de l'entreprise à la vue ModifierContact et affichage de la vue
        return view('Contact\ModifierContact',compact('entreprise_id','entreprises','interlocuteurs','contact'));
    }

    //Fonction de modification d'un objet en base de données
    public function mettreAJour(ContactUpdateRequest $request, $id)
    {
        //Appel à la méthode du répository pour modifier le contact
        $this->contactRepository->update($id, $request->all());
        //redirection à l'action FicheContact du controlleur avec l'id du contact
        return redirect()->route('FicheContact',['id' => $id]);
    }

    //Fonction de suppression d'un contact
    public function supprimer($id)
    {
        //Récupération de l'id de l'entreprise
        $entreprise_id=$this->contactRepository->getById($id)->entreprise_id;
        //Appel à la méthode du repository pour supprimer l'objet de la base de données
        $this->contactRepository->destroy($id);
        //Redirection à l'action FicheEntreprise avec l'id de l'entreprise
        return redirect()->route('FicheEntreprise',['id' => $entreprise_id]);
    }
}
