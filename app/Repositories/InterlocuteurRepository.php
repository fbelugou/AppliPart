<?php

namespace App\Repositories;

use App\Interlocuteur;

class InterlocuteurRepository
{

    protected $interlocuteur;

    public function __construct(Interlocuteur $interlocuteur)
  	{
  		  $this->interlocuteur = $interlocuteur;
  	}

  	private function save(Interlocuteur $interlocuteur, Array $inputs)
  	{
        $interlocuteur->nom=$inputs['nom'];
        //$interlocuteur->partenaireRegulier=isset($inputs['partenaireRegulier']);
        //$interlocuteur->siegeSocial=isset($inputs['siegeSocial']);
        $interlocuteur->taille=$inputs['taille'];
        $interlocuteur->rue=$inputs['rue'];
        $interlocuteur->cp=$inputs['cp'];
        $interlocuteur->siteWeb=$inputs['siteWeb'];
        $interlocuteur->telephone=$inputs['tel'];
        $interlocuteur->commentaire=$inputs['commentaire'];
        //$interlocuteur->interlocuteur_id=$inputs['interlocuteur_id'];
        //$interlocuteur->coord_id=$inputs['coord_id'];

    		$interlocuteur->save();
  	}

  	public function getInterlocuteurs()
  	{
  		  return $this->interlocuteur->orderBy('prenom','asc')->get();
  	}

    public function getInterlocuteursId()
  	{
  		  return $this->interlocuteur->orderBy('id','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$interlocuteur = new $this->interlocuteur;

    		$this->save($interlocuteur, $inputs);

    		return $interlocuteur;
  	}

  	public function getById($id)
  	{
    		return $this->interlocuteur->findOrFail($id);
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
