<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\GroupeRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupeController extends Controller
{
    protected $groupeRepository;

    public function __construct(groupeRepository $groupeRepository)
    {
        $this->groupeRepository = $groupeRepository;
    }

    public function lister()
    {
        $groupes = $this->groupeRepository->getGroupes();

        return view('ListeGroupes', compact('groupes'));
    }

    public function ajouter()
    {
        return view('AjoutGroupe');
    }

    public function enregistrer(GroupeCreateRequest $request)
    {
        $groupe = $this->groupeRepository->store($request->all());

        return redirect('groupe')->withOk("Le groupe " . $groupe->name . " a été créé.");
    }

    public function afficher($id)
    {
        $groupe = $this->groupeRepository->getById($id);

        return view('FicheGroupe',  compact('groupe'));
    }

    public function modifier($id)
    {
        $groupe = $this->groupeRepository->getById($id);

        return view('edit',  compact('groupe'));
    }

    public function mettreAJour(GroupeUpdateRequest $request, $id)
    {
        $this->groupeRepository->update($id, $request->all());

        return redirect('groupe')->withOk("Le groupe " . $request->input('name') . " a été modifié.");
    }

    public function supprimer($id)
    {
        $this->groupeRepository->destroy($id);

        return back();
    }
}
