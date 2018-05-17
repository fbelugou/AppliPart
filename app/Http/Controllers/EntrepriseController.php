<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\EntrepriseRepository;
use App\Repositories\GroupeRepository;
use App\Repositories\ActiviteRepository;
use App\Repositories\FiliereRepository;
use App\Repositories\InterlocuteurRepository;

use App\Http\Requests\EntrepriseCreateRequest;
use App\Http\Requests\EntrepriseUpdateRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $groupeRepository;
    protected $activiteRepository;
    protected $filiereRepository;
    protected $interlocuteurRepository;

      public function __construct(EntrepriseRepository $entrepriseRepository,
                                  GroupeRepository $groupeRepository,
                                  ActiviteRepository $activiteRepository,
                                  FiliereRepository $filiereRepository,
                                  InterlocuteurRepository $interlocuteurRepository)
    {
        $this->entrepriseRepository = $entrepriseRepository;
        $this->groupeRepository = $groupeRepository;
        $this->activiteRepository = $activiteRepository;
        $this->filiereRepository = $filiereRepository;
        $this->interlocuteurRepository = $interlocuteurRepository;
    }

    public function listerEntreprises()
    {
        $entreprises = $this->entrepriseRepository->getEntreprises();

        return view('Entreprise\ListeEntreprises', compact('entreprises'));
    }

    public function listerPartenaires()
    {
        $entreprises = $this->entrepriseRepository->getPartenaires();

        return view('Entreprise\ListePartenaires', compact('entreprises'));
    }

    public function ajouter()
    {
        $groupes[0]='Choisissez un groupe';
        $tabGroupes = $this->groupeRepository->getGroupes();
        foreach ($tabGroupes as $groupe) {
            $groupes[$groupe->id]=$groupe->nom;
        }
        $activites[0]='Choisissez une activité';
        $tabActivites = $this->activiteRepository->getActivites();
        foreach ($tabActivites as $activite) {
            $activites[$activite->id]=$activite->libelle;
        }
        $filieres[0]='Choisissez une filière';
        $tabfilieres = $this->filiereRepository->getFilieres();
        foreach ($tabfilieres as $filiere) {
            $filieres[$filiere->id]=$filiere->metier;
        }
        $interlocuteurs[0]='Choisissez un interlocuteur';
        $tabinterlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();
        foreach ($tabinterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom." ".$interlocuteur->nom;
        }

        return view('Entreprise\AjoutEntreprise',compact('groupes','activites','filieres','interlocuteurs'));
    }

    public function enregistrer(EntrepriseCreateRequest $request)
    {
        $entreprise = $this->entrepriseRepository->store($request->all());

        return redirect()->route('FicheEntreprise',['id' => $entreprise->id]);
    }

    public function afficher($id)
    {
        $entreprise = $this->entrepriseRepository->getById($id);

        return view('Entreprise\FicheEntreprise',  compact('entreprise'));
    }

    public function modifier($id)
    {
        $entreprise = $this->entrepriseRepository->getById($id);
        $groupes[0]='Choisissez un groupe';
        $tabGroupes = $this->groupeRepository->getGroupes();
        foreach ($tabGroupes as $groupe) {
            $groupes[$groupe->id]=$groupe->nom;
        }
        $activites[0]='Choisissez une activité';
        $tabActivites = $this->activiteRepository->getActivites();
        foreach ($tabActivites as $activite) {
            $activites[$activite->id]=$activite->libelle;
        }
        $filieres[0]='Choisissez une filière';
        $tabfilieres = $this->filiereRepository->getFilieres();
        foreach ($tabfilieres as $filiere) {
            $filieres[$filiere->id]=$filiere->metier;
        }
        $interlocuteurs[0]='Choisissez un interlocuteur';
        $tabinterlocuteurs = $this->interlocuteurRepository->getInterlocuteurs();
        foreach ($tabinterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom." ".$interlocuteur->nom;
        }
        return view('Entreprise\ModifierEntreprise',  compact('entreprise','groupes','activites','filieres','interlocuteurs'));
    }

    public function mettreAJour(EntrepriseUpdateRequest $request, $id)
    {
        $this->entrepriseRepository->update($id, $request->all());
        return redirect()->route('FicheInterlocuteur',['id' => $id]);
    }

    public function supprimer($id)
    {
        $this->entrepriseRepository->destroy($id);

        return view('Accueil');
    }
}
