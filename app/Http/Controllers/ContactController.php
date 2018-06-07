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
        $this->contactRepository = $contactRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->interlocuteurRepository = $interlocuteurRepository;
    }

    public function lister()
    {
        $contacts = $this->contactRepository->getContacts();

        return view('Contact\ListeContacts', compact('contacts'));
    }

    public function ajouter($entreprise_id)
    {
        $entreprises[0]='Choisissez une entreprise';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        $tabInterlocuteurs=$this->interlocuteurRepository->getInterlocuteursByEntreprise($entreprise_id);
        if(empty($tabInterlocuteurs->first())){
            $interlocuteurs=$this->interlocuteurRepository->getInterlocuteurs();
        }
        foreach ($tabInterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->interlocuteur_id]=$interlocuteur->prenom.' '.$interlocuteur->nom;
        }
        return view('Contact\AjoutContact',compact('entreprise_id','entreprises','interlocuteurs'));
    }

    public function enregistrer(ContactCreateRequest $request)
    {
        $contact = $this->contactRepository->store($request->all());

        return redirect()->route('FicheContact',['id' => $contact->id]);
    }

    public function afficher($id)
    {
        $contact = $this->contactRepository->getById($id);
        $entreprise = $this->entrepriseRepository->getById($contact->entreprise_id);
        $interlocuteur = $this->interlocuteurRepository->getById($contact->interlocuteur_id);

        return view('Contact\FicheContact',  compact('contact','entreprise','interlocuteur'));
    }

    public function modifier($id)
    {
        $contact = $this->contactRepository->getById($id);
        $entreprise_id=$contact->entreprise_id;
        $entreprises[0]='Choisissez une entreprise';
        $tabEntreprises = $this->entrepriseRepository->getEntreprises();
        foreach ($tabEntreprises as $entreprise) {
            $entreprises[$entreprise->id]=$entreprise->nom;
        }
        $tabInterlocuteurs=$this->interlocuteurRepository->getInterlocuteursByEntreprise($entreprise_id);
        foreach ($tabInterlocuteurs as $interlocuteur) {
            $interlocuteurs[$interlocuteur->id]=$interlocuteur->prenom.' '.$interlocuteur->nom;
        }

        return view('Contact\ModifierContact',compact('entreprise_id','entreprises','interlocuteurs','contact'));
    }

    public function mettreAJour(ContactUpdateRequest $request, $id)
    {
        $this->contactRepository->update($id, $request->all());

        return redirect()->route('FicheContact',['id' => $id]);
    }

    public function supprimer($id)
    {
        $entreprise_id=$this->contactRepository->getById($id)->entreprise_id;
        $this->contactRepository->destroy($id);

        return redirect()->route('FicheEntreprise',['id' => $entreprise_id]);
    }
}
