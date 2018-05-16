<?php

namespace App\Repositories;

use App\Activite;

class ActiviteRepository
{

    protected $activite;

    public function __construct(Activite $activite)
  	{
  		  $this->activite = $activite;
  	}

  	private function save(Activite $activite, Array $inputs)
  	{
        $activite->nom=$inputs['nom'];
        //$activite->partenaireRegulier=isset($inputs['partenaireRegulier']);
        //$activite->siegeSocial=isset($inputs['siegeSocial']);
        $activite->taille=$inputs['taille'];
        $activite->rue=$inputs['rue'];
        $activite->cp=$inputs['cp'];
        $activite->siteWeb=$inputs['siteWeb'];
        $activite->telephone=$inputs['tel'];
        $activite->commentaire=$inputs['commentaire'];
        //$activite->activite_id=$inputs['activite_id'];
        //$activite->coord_id=$inputs['coord_id'];

    		$activite->save();
  	}

  	public function getActivites()
  	{
  		  return $this->activite->orderBy('libelle','asc')->get();
  	}

    public function getActivitesId()
  	{
  		  return $this->activite->orderBy('id','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$activite = new $this->activite;

    		$this->save($activite, $inputs);

    		return $activite;
  	}

  	public function getById($id)
  	{
    		return $this->activite->findOrFail($id);
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
