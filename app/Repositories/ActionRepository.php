<?php

namespace App\Repositories;

use App\Action;

class ActionRepository
{

    protected $action;

    public function __construct(Action $action)
  	{
  		  $this->action = $action;
  	}

  	private function save(Action $action, Array $inputs)
  	{
        $action->date=date_create($inputs['date']);
        $action->commentaire=$inputs['commentaire'];
        $action->entreprise_id=$inputs['entreprise'];

        switch ($inputs['nature']) {
          case 1:
            $action->nature='Stage';
            break;
          case 2:
            $action->nature='Alternance';
            break;
          case 3:
            $action->nature='JobDating';
            break;
          case 4:
            $action->nature='Visite d\'entreprise';
            break;
          case 5:
            $action->nature='Taxe d\'apprentissage';
            break;
          case 6:
            $action->nature='Jury d\'examen';
            break;
          case 7:
            $action->nature='Parrainage';
            break;
          case 8:
            $action->nature='Intervention technique';
            break;
          case 9:
            $action->nature='Formation stagiaire';
            break;
          case 10:
            $action->nature='Formation formateur';
            break;
          case 11:
            $action->nature='Embauche';
            break;
          case 12:
            $action->nature='Don de materiel';
            break;
          case 13:
            $action->nature='Autres('.$inputs['autres'].')';
            break;
        }

    		$action->save();
  	}

  	public function getActions()
  	{
  		  return $this->action->orderBy('date','desc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$action = new $this->action;

    		$this->save($action, $inputs);

    		return $action;
  	}

  	public function getById($id)
  	{
    		return $this->action->findOrFail($id);
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
