<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\EntrepriseRepository;
use App\Repositories\GroupeRepository;
use App\Repositories\ActiviteRepository;
use App\Repositories\FiliereRepository;
use App\Repositories\InterlocuteurRepository;
use App\Repositories\EntrepriseEventRepository;
use App\Repositories\ActionRepository;
use App\Repositories\CoordonneesRepository;

use App\Http\Requests\EntrepriseCreateRequest;
use App\Http\Requests\EntrepriseUpdateRequest;
use App\Http\Requests\EntrepriseSearchRequest;
use App\Http\Requests\EntrepriseDistSearchRequest;
use App\Http\Requests\MailsEntreprisesRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $groupeRepository;
    protected $activiteRepository;
    protected $filiereRepository;
    protected $interlocuteurRepository;
    protected $evenementRepository;
    protected $actionRepository;
    protected $coordonneesRepository;

      public function __construct(EntrepriseRepository $entrepriseRepository,
                                  GroupeRepository $groupeRepository,
                                  ActiviteRepository $activiteRepository,
                                  FiliereRepository $filiereRepository,
                                  InterlocuteurRepository $interlocuteurRepository,
                                  EntrepriseEventRepository $evenementRepository,
                                  ActionRepository $actionRepository,
                                  coordonneesRepository $coordonneesRepository)
    {
        //Recuperation des repository nécéssaires
        $this->entrepriseRepository = $entrepriseRepository;
        $this->groupeRepository = $groupeRepository;
        $this->activiteRepository = $activiteRepository;
        $this->filiereRepository = $filiereRepository;
        $this->interlocuteurRepository = $interlocuteurRepository;
        $this->evenementRepository = $evenementRepository;
        $this->actionRepository = $actionRepository;
        $this->coordonneesRepository = $coordonneesRepository;
    }

    //Fonction de listage des entreprises
    public function listerEntreprises()
    {
        //Récupération de toutes les entreprises
        $entreprises = $this->entrepriseRepository->getEntreprises();
        //Envoi des entreprises à la vue ListeEntreprises et affichage de la vue
        return view('Entreprise\ListeEntreprises', compact('entreprises'));
    }

    //Fonction de listage des partenaires réguliers
    public function listerPartenaires()
    {
        //Récupération des partenaires réguliers
        $entreprises = $this->entrepriseRepository->getPartenaires();
        //Envoi des partenaires réguliers à la vue ListePartenaires et affichage de la vue
        return view('Entreprise\ListePartenaires', compact('entreprises'));
    }

    //Fonction d'ajout d'une entreprise
    public function ajouter()
    {
        //Création de la liste des groupes
        $groupes[0]='Choisissez un groupe';
        //Récupération des groupes
        $tabGroupes = $this->groupeRepository->getGroupes();
        //Mise en forme des objets groupes pour la liste déroulante
        foreach ($tabGroupes as $groupe) {
            $groupes[$groupe->id]=$groupe->nom;
        }
        //Création de la liste des activités
        $activites[0]='Choisissez une activité';
        //Récupération des activités
        $tabActivites = $this->activiteRepository->getActivites();
        //Mise en forme des objets activités pour la liste déroulante
        foreach ($tabActivites as $activite) {
            $activites[$activite->id]=$activite->libelle;
        }
        //Création de la liste des filières
        $filieres[0]='Choisissez une filière';
        //Récupération des filières
        $tabfilieres = $this->filiereRepository->getFilieres();
        //Mise en forme des objets filières pour la liste déroulante
        foreach ($tabfilieres as $filiere) {
            $filieres[$filiere->id]=$filiere->metier;
        }
        //Création de la liste des interlocuteurs
        $interlocuteurs[0]='Choisissez un interlocuteur';
        //Récupération des interlocuteurs
        $tabinterlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();
        //Mise en forme des objets interlocuteurs pour la liste déroulante
        foreach ($tabinterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom." ".$interlocuteur->nom;
        }
        //Envoi des tableaux pour les listes déroulantes à la vue AjoutEntreprise et affichage de la vue
        return view('Entreprise\AjoutEntreprise',compact('groupes','activites','filieres','interlocuteurs'));
    }

    //Fonction d'enregistrement en base de données d'une entreprise avec des données d'un formulaire
    public function enregistrer(EntrepriseCreateRequest $request)
    {
        //Enregistrement en base de l'entreprise
        $entreprise = $this->entrepriseRepository->store($request->all());
        //Redirection à l'action FicheEntreprise du controlleur avec l'id de l'entreprise
        return redirect()->route('FicheEntreprise',['id' => $entreprise->id]);
    }

    //Fonction d'affichage d'une entreprise
    public function afficher($id)
    {
        //Récupération de l'entreprise via l'id
        $entreprise = $this->entrepriseRepository->getById($id);
        //Envoi de l'entreprise à la vue FicheEntreprise et affichage de la vue
        return view('Entreprise\FicheEntreprise',  compact('entreprise'));
    }

    //Fonction d'affichage de formulaire de modification d'une entreprise
    public function modifier($id)
    {
        //Récupération de l'entreprise
        $entreprise=$this->entrepriseRepository->getById($id);
        //Création de la liste des groupes
        $groupes[0]='Choisissez un groupe';
        //Récupération des groupes
        $tabGroupes = $this->groupeRepository->getGroupes();
        //Mise en forme des objets groupes pour la liste déroulante
        foreach ($tabGroupes as $groupe) {
            $groupes[$groupe->id]=$groupe->nom;
        }
        //Création de la liste des activités
        $activites[0]='Choisissez une activité';
        //Récupération des activités
        $tabActivites = $this->activiteRepository->getActivites();
        //Mise en forme des objets activités pour la liste déroulante
        foreach ($tabActivites as $activite) {
            $activites[$activite->id]=$activite->libelle;
        }
        //Création de la liste des filières
        $filieres[0]='Choisissez une filière';
        //Récupération des filières
        $tabfilieres = $this->filiereRepository->getFilieres();
        //Mise en forme des objets filières pour la liste déroulante
        foreach ($tabfilieres as $filiere) {
            $filieres[$filiere->id]=$filiere->metier;
        }
        //Création de la liste des interlocuteurs
        $interlocuteurs[0]='Choisissez un interlocuteur';
        //Récupération des interlocuteurs
        $tabinterlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();
        //Mise en forme des objets interlocuteurs pour la liste déroulante
        foreach ($tabinterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom." ".$interlocuteur->nom;
        }
        //Envoi de l'entreprise et des listes à la vue ModifierEntreprise et affichage de la vue
        return view('Entreprise\ModifierEntreprise',  compact('entreprise','groupes','activites','filieres','interlocuteurs'));
    }

    //Fonction de modification d'une entreprise en base de données
    public function mettreAJour(EntrepriseUpdateRequest $request, $id)
    {
        //Appel à la méthode du répository pour modifier l'entreprise
        $this->entrepriseRepository->update($id, $request->all());
        //redirection à l'action FicheEntreprise du controlleur avec l'id de l'entreprise
        return redirect()->route('FicheEntreprise',['id' => $id]);
    }

    //Fonction de suppression d'une entreprise
    public function supprimer($id)
    {
        //Récupération de l'entreprise
        $entreprise = $this->entrepriseRepository->getById($id);
        //Suppression du lien etre l'entreprise et les interlocuteurs
        $entreprise->interlocuteurs()->detach();
        //Suppression du lien etre l'entreprise et les filieres
        $entreprise->filieres()->detach();
        //Suppression du lien etre l'entreprise et les activites
        $entreprise->activites()->detach();
        //Suppression des evenements de l'entreprise
        foreach($entreprise->evenements() as $evenement){
            $this->evenementRepository->destroy($evenement->id);
        }
        //Suppression des actions de l'entreprise
        foreach($entreprise->actions() as $action){
            $this->actionRepository->destroy($action->id);
        }
        //Suppression des coordonnees de l'entreprise
        foreach($entreprise->coordonnees() as $coord){
            $this->coordonneesRepository->destroy($coord->id);
        }

        //Appel à la méthode du repository pour supprimer l'entreprise de la base de données
        $this->entrepriseRepository->destroy($id);
          //Redirection à l'accueil
        return Redirect()->route('Accueil');
    }

    //Fonction de recherche d'entreprises par rapport au nom
    public function recherche(EntrepriseSearchRequest $request)
    {
        //Appel à la méthode du repository pour chercher une entreprise
        $entreprises=$this->entrepriseRepository->search($request->all());
        //Envoi des résultats à la vue RechercheEntreprises et affichage de la vue
        return view('Entreprise\RechercheEntreprises',  compact('entreprises'));
    }

    //Fonction de recherche d'entreprises par rapport à une distance
    public function rechercheDist(EntrepriseDistSearchRequest $request)
    {
        //Appel à la méthode du repository pour chercher une entreprise par rapport à une distance
        $resultat=$this->entrepriseRepository->searchDist($request->all());
        //Si une erreur c'est produite redirection versu ne page d'erreur
        if($resultat['etat']===false){
            return view('Erreur',['message'=>$resultat['message']]);
        }
        //Récupération des entreprises
        $entreprises=$resultat['entreprises'];
        //Envoi des entreprises à la vue RechercheEntreprises et affichage de la vue
        return view('Entreprise\RechercheEntreprises',  compact('entreprises'));
    }

    //Fonction d'affichage d'un formulaire de génération d'une liste de mails
    public function formulaireMailsEntreprise()
    {
        //Récupération des entreprises
        $entreprises = $this->entrepriseRepository->getEntreprises();
        //Envoi des entreprises à la vue FormulaireMails et affichage de la vue
        return view('Entreprise\FormulaireMails',compact('entreprises'));
    }

    //Fonction de génération d'une liste de mails avec les données d'un formulaire
    public function mailsEntreprise(MailsEntreprisesRequest $request)
    {
        //Appel à la méthode du répository pour générer la liste de mails
        $mails=$this->entrepriseRepository->listeMail($request->all());
        //Envoi de la liste de mails à la vue ListeMail et affichage de la vue
        return view('ListeMail',compact('mails'));
    }
}
