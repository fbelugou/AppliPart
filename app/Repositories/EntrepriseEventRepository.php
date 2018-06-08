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

    //Fonction d'enregistrement en base de données d'un evenement sur une fiche d'entreprise
  	private function save(EntrepriseEvent $entrepriseEvent, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans l'objet entrepriseEvent fourni
        $entrepriseEvent->utilisateur=$inputs[0];
        $entrepriseEvent->date=$inputs[1];
        $entrepriseEvent->nature=$inputs[2];
        $entrepriseEvent->commentaire=$inputs[3];
        $entrepriseEvent->entreprise_id=$inputs[4];
        //Enregistrement en base de données de l'objet
    		$entrepriseEvent->save();
  	}

    //Fonction d'enregistrement d'un evenement sur une fiche d'entreprise
  	public function store(Array $inputs)
  	{
        //Création d'un objet entrepriseEvent
    		$entrepriseEvent = new $this->entrepriseEvent;
        //Appel à la fonction d'enregistrement en base de données d'un événement sur une fiche d'entreprise
    		$this->save($entrepriseEvent, $inputs);
        //Retourne l'objet créé
    		return $entrepriseEvent;
  	}
}
