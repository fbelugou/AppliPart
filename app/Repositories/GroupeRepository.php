<?php

namespace App\Repositories;

use App\Groupe;

class GroupeRepository
{

    protected $groupe;

    public function __construct(Groupe $groupe)
  	{
  		  $this->groupe = $groupe;
  	}

  	private function save(Groupe $groupe, Array $inputs)
  	{
        $groupe->nom=$inputs['nom'];
        //$groupe->partenaireRegulier=isset($inputs['partenaireRegulier']);
        //$groupe->siegeSocial=isset($inputs['siegeSocial']);
        $groupe->taille=$inputs['taille'];
        $groupe->rue=$inputs['rue'];
        $groupe->cp=$inputs['cp'];
        $groupe->siteWeb=$inputs['siteWeb'];
        $groupe->telephone=$inputs['tel'];
        $groupe->commentaire=$inputs['commentaire'];
        //$groupe->groupe_id=$inputs['groupe_id'];
        //$groupe->coord_id=$inputs['coord_id'];

    		$groupe->save();
  	}

  	public function getGroupes()
  	{
  		  return $this->groupe->orderBy('nom','asc')->get();
  	}

    public function getGroupesId()
  	{
  		  return $this->groupe->orderBy('id','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$groupe = new $this->groupe;

    		$this->save($groupe, $inputs);

    		return $groupe;
  	}

  	public function getById($id)
  	{
    		return $this->groupe->findOrFail($id);
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
