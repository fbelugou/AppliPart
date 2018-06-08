<?php

namespace App\Repositories;

use App\InterlocuteurEvent;

class InterlocuteurEventRepository
{

    protected $interlocuteurEvent;

    public function __construct(InterlocuteurEvent $interlocuteurEvent)
  	{
  		  $this->interlocuteurEvent = $interlocuteurEvent;
  	}

    //Fonction d'enregistrement en base de données d'un evenement sur une fiche d'entreprise
  	private function save(InterlocuteurEvent $interlocuteurEvent, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans l'objet interlocuteurEvent fourni
        $interlocuteurEvent->utilisateur=$inputs[0];
        $interlocuteurEvent->date=$inputs[1];
        $interlocuteurEvent->nature=$inputs[2];
        $interlocuteurEvent->commentaire=$inputs[3];
        $interlocuteurEvent->interlocuteur_id=$inputs[4];
        //Enregistrement en base de données de l'objet
    		$interlocuteurEvent->save();
  	}

    //Fonction d'enregistrement d'un evenement sur une fiche d'entreprise
  	public function store(Array $inputs)
  	{
        //Création d'un objet interlocuteurEvent
    		$interlocuteurEvent = new $this->interlocuteurEvent;
        //Appel à la fonction d'enregistrement en base de données d'un événement sur une fiche d'interlocuteur
        $this->save($interlocuteurEvent, $inputs);
        //Retourne l'objet créé
    		return $interlocuteurEvent;
  	}
}
