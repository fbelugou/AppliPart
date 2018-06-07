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

  	private function save(InterlocuteurEvent $interlocuteurEvent, Array $inputs)
  	{
        $interlocuteurEvent->utilisateur=$inputs[0];
        $interlocuteurEvent->date=$inputs[1];
        $interlocuteurEvent->nature=$inputs[2];
        $interlocuteurEvent->commentaire=$inputs[3];
        $interlocuteurEvent->interlocuteur_id=$inputs[4];

    		$interlocuteurEvent->save();
  	}

  	public function store(Array $inputs)
  	{
    		$interlocuteurEvent = new $this->interlocuteurEvent;

    		$this->save($interlocuteurEvent, $inputs);

    		return $interlocuteurEvent;
  	}
}
