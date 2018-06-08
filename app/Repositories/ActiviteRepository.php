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

    //Récupère les activités
  	public function getActivites()
  	{
  		  return $this->activite->orderBy('libelle','asc')->get();
  	}
}
