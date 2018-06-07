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
        $entrepriseEvent->utilisateur=$inputs[0];
        $entrepriseEvent->date=$inputs[1];
        $entrepriseEvent->nature=$inputs[2];
        $entrepriseEvent->commentaire=$inputs[3];
        $entrepriseEvent->entreprise_id=$inputs[4];

    		$entrepriseEvent->save();
  	}

  	public function store(Array $inputs)
  	{
    		$entrepriseEvent = new $this->entrepriseEvent;

    		$this->save($entrepriseEvent, $inputs);

    		return $entrepriseEvent;
  	}
}
