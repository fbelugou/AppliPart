<?php

namespace App\Repositories;

use App\Entreprise;
use App\Repositories\GroupeRepository;

class EntrepriseRepository
{

    protected $entreprise;
    protected $groupeRepository;

    public function __construct(Entreprise $entreprise,
                                GroupeRepository $groupeRepository)
  	{
  		  $this->entreprise = $entreprise;
        $this->groupeRepository = $groupeRepository;
  	}

  	private function save(Entreprise $entreprise, Array $inputs)
  	{
        $entreprise->nom=$inputs['nom'];
        $entreprise->partenaireRegulier=isset($inputs['partenaireRegulier']);
        $entreprise->siegeSocial=isset($inputs['siegeSocial']);
        $entreprise->taille=$inputs['taille'];
        $entreprise->rue=$inputs['rue'];
        $entreprise->ville=$inputs['ville'];
        $entreprise->cp=$inputs['cp'];
        $entreprise->siteWeb=$inputs['siteWeb'];
        $entreprise->telephone=$inputs['tel'];
        $entreprise->commentaire=$inputs['commentaire'];
        if($inputs['groupe_id']!=0){
            $entreprise->groupe_id=$inputs['groupe_id'];
        }
        $entreprise->save();
        if(isset($inputs['activites'])){
            $entreprise->activites()->sync($inputs['activites']);
        }
        if(isset($inputs['filieres'])){
            $entreprise->filieres()->sync($inputs['filieres']);
        }
        if(isset($inputs['interlocuteurs'])){
            $entreprise->interlocuteurs()->sync($inputs['interlocuteurs']);
        }
  	}

    public function getEntreprises()
  	{
  		  return $this->entreprise->orderBy('nom','asc')->get();
  	}

    public function getPartenaires()
  	{
  		  return $this->entreprise->where('partenaireRegulier','=',1)->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$entreprise = new $this->entreprise;

    		$this->save($entreprise, $inputs);

    		return $entreprise;
  	}

  	public function getById($id)
  	{
    		return $this->entreprise->findOrFail($id);
  	}

  	public function update($id, Array $inputs)
  	{
  		  $this->save($this->getById($id), $inputs);
  	}

    public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

}
