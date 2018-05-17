<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\GroupeRepository;

use App\Http\Requests\GroupeCreateRequest;
use App\Http\Requests\GroupeUpdateRequest;

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

        return view('Groupe\ListeGroupes', compact('groupes'));
    }

    public function ajouter()
    {
        return view('Groupe\AjoutGroupe');
    }

    public function enregistrer(GroupeCreateRequest $request)
    {
        $groupe = $this->groupeRepository->store($request->all());

        return redirect()->route('FicheGroupe',['id' => $groupe->id]);
    }

    public function afficher($id)
    {
        $groupe = $this->groupeRepository->getById($id);

        return view('Groupe\FicheGroupe',  compact('groupe'));
    }

    public function modifier($id)
    {
        $groupe = $this->groupeRepository->getById($id);

        return view('Groupe\ModifierGroupe',  compact('groupe'));
    }

    public function mettreAJour(GroupeUpdateRequest $request, $id)
    {
        $this->groupeRepository->update($id, $request->all());

        return redirect()->route('FicheGroupe',['id' => $id]);
    }

    public function supprimer($id)
    {
        $this->groupeRepository->destroy($id);

        return redirect()->route('Groupes');
    }
}
