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

    //Retourne la liste des filières (utilisé pour les formulaires d'ajout et de modification d'entreprises)
    public function getFilieres()
  	{
  		  return $this->filiere->orderBy('metier','asc')->get();
  	}

}
