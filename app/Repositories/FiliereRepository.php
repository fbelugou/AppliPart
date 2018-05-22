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

    public function getFilieres()
  	{
  		  return $this->filiere->orderBy('metier','asc')->get();
  	}
    
}
