<?php

namespace App\Repositories;

use App\Filiere;

class FiliereRepository
{

    protected $filiere;

    public function __construct(Filiere $filiere)
  	{
  		  $this->filiere = $filiere;
  	}

  	private function save(Filiere $filiere, Array $inputs)
  	{
        $filiere->nom=$inputs['nom'];
        //$filiere->partenaireRegulier=isset($inputs['partenaireRegulier']);
        //$filiere->siegeSocial=isset($inputs['siegeSocial']);
        $filiere->taille=$inputs['taille'];
        $filiere->rue=$inputs['rue'];
        $filiere->cp=$inputs['cp'];
        $filiere->siteWeb=$inputs['siteWeb'];
        $filiere->telephone=$inputs['tel'];
        $filiere->commentaire=$inputs['commentaire'];
        //$filiere->filiere_id=$inputs['filiere_id'];
        //$filiere->coord_id=$inputs['coord_id'];

    		$filiere->save();
  	}

  	public function getFilieres()
  	{
  		  return $this->filiere->orderBy('metier','asc')->get();
  	}

    public function getFilieresId()
  	{
  		  return $this->filiere->orderBy('id','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$filiere = new $this->filiere;

    		$this->save($filiere, $inputs);

    		return $filiere;
  	}

  	public function getById($id)
  	{
    		return $this->filiere->findOrFail($id);
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
