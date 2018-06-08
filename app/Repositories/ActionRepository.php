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

    //Fonction d'enregistrement en base de données d'une action
  	private function save(Action $action, Array $inputs)
  	{
        //Récupération de la date du commentaire et de l'id de l'entreprise
        $action->date=date_create($inputs['date']);
        $action->commentaire=$inputs['commentaire'];
        $action->entreprise_id=$inputs['entreprise'];
        //Récupération et mise en chaine de caractères de la nature
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
        //Enregistrement des modifications apportés à l'objet
    		$action->save();
  	}

    //Fonction de récupération des actions
  	public function getActions()
  	{
        //Retroune les actions triés par date du plus récent au plus ancien
  		  return $this->action->orderBy('date','desc')->get();
  	}

    //Fonction d'enregistrement d'une action
  	public function store(Array $inputs)
  	{
        //Création d'une action
    		$action = new $this->action;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$this->save($action, $inputs);
        //retourne l'action
    		return $action;
  	}

    //Récupère une action selon son id
  	public function getById($id)
  	{
    		return $this->action->findOrFail($id);
  	}

    //Fonction de mise à jour d'une action
  	public function update($id, Array $inputs)
  	{
        //Récupère une action et appelle la méthode de sauvegarde en base de données du controlleur
  		  $this->save($this->getById($id), $inputs);
  	}

    //Fonction de suppression d'une action en base de données
  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    //Fonction de recherche d'une action par rapport à la nature
    public function search($nature)
  	{
        //Récupère les actions par ordre de date du plus récent au plus ancien
        if($nature!='Autres%') {
            return $this->action->where('nature','=',$nature)->orderBy('date','desc')->get();
        }
        else {
            return $this->action->where('nature','like',$nature)->orderBy('date','desc')->get();
        }

  	}

}
