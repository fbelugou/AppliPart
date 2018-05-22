<?php

namespace App\Repositories;

use App\EntrepriseEvent;

class EntrepriseEventRepository
{

    protected $entrepriseEvent;

    public function __construct(EntrepriseEvent $entrepriseEvent)
  	{
  		  $this->entrepriseEvent = $entrepriseEvent;
  	}

  	private function save(EntrepriseEvent $entrepriseEvent, Array $inputs)
  	{
        $entrepriseEvent->nom=$inputs['nom'];
        $entrepriseEvent->taille=$inputs['taille'];

    		$entrepriseEvent->save();
  	}

  	public function getEntrepriseEvents()
  	{
  		  return $this->entrepriseEvent->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$entrepriseEvent = new $this->entrepriseEvent;

    		$this->save($entrepriseEvent, $inputs);

    		return $entrepriseEvent;
  	}

  	public function getById($id)
  	{
    		return $this->entrepriseEvent->findOrFail($id);
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
