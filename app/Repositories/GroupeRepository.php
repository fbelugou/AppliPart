<?php

namespace App\Repositories;

use App\Groupe;

class GroupeRepository
{

    protected $groupe;

    public function __construct(Groupe $groupe)
  	{
  		  $this->groupe = $groupe;
  	}

    //Fonction d'enregistrement en base de données d'un groupe
  	private function save(Groupe $groupe, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans l'objet
        $groupe->nom=$inputs['nom'];
        $groupe->taille=$inputs['taille'];
        //Enregistrement en base de données
    		$groupe->save();
  	}

    //Fonction de récupération des groupes triés par ordre alphabétique sur le nom
  	public function getGroupes()
  	{
  		  return $this->groupe->orderBy('nom','asc')->get();
  	}

    //Fonction d'enregistrement d'un groupe
  	public function store(Array $inputs)
  	{
        //Création d'un groupe
    		$groupe = new $this->groupe;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$this->save($groupe, $inputs);
        //Retourne le groupe ajouté en base de données
    		return $groupe;
  	}

    //Fonction de récupération d'un groupe selon l'id
  	public function getById($id)
  	{
    		return $this->groupe->findOrFail($id);
  	}

    //Fonction de mise à jour d'un groupe
  	public function update($id, Array $inputs)
  	{
        //Récupération du groupe et appel à la fonction de sauvegarde en base de données avec le groupe et les informations du formulaire
  		  $this->save($this->getById($id), $inputs);
  	}

    //Fonction de suppression d'un groupe en base de données
  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    //Fonction de recherche d'un groupe
    public function search(Array $inputs)
    {
        //On récupère tout les groupes correspondant à la recherche
        $tabGroupes= $this->groupe->where('nom','like','%'.$inputs['grp'].'%')->orderBy('nom','asc')->get();
        if($inputs['limiteGrp']=='true'){
            //Si la limitation au partenaires réguliers est activée on va limiter les résultats aux groupes
            //Qui possèdent au moins une entreprise partenaire régulier
            $groupes=array();
            //Pour charque groupes on va chercher si une des entreprises est partenaire réguliers
            foreach($tabGroupes as $groupe){
                foreach($groupe->entreprises as $entreprise){
                    if($entreprise->partenaireRegulier){
                        //Si l'entreprise est partenaire régulier et que le groupe n'as pas déjà été ajouté
                        //On l'ajoute au tableau des groupes à retrouner
                        if(!in_array($groupe,$groupes)){
                            $groupes[]=$groupe;
                        }
                    }
                }
            }
            //On retourne les groupes partenaires réguliers
            return $groupes;
        }
        else{
            //Si la limite aux partenaires réguliers est désactivé on retourne tout les groupes correspondant à la recherche
            return $tabGroupes;
        }
    }

}
