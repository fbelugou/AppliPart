<?php

namespace App\Repositories;

use App\Interlocuteur;
use App\Repositories\InterlocuteurEventRepository;
use Illuminate\Support\Facades\DB;

class InterlocuteurRepository
{

    protected $interlocuteur;

    public function __construct(Interlocuteur $interlocuteur,InterlocuteurEventRepository $interlocuteurEventRepository)
  	{
  		  $this->interlocuteur = $interlocuteur;
        $this->interlocuteurEventRepository = $interlocuteurEventRepository;
  	}

    //Fonction d'enregistrement en base de données de coordonnées
  	private function save(Interlocuteur $interlocuteur, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans lobjet fourni
        $interlocuteur->prenom=$inputs['prenom'];
        $interlocuteur->nom=$inputs['nom'];
        $interlocuteur->transmission=isset($inputs['transmission']);
        $interlocuteur->fonction=$inputs['fonction'];
        $interlocuteur->telFixe=$inputs['telFixe'];
        $interlocuteur->telMobile=$inputs['telMobile'];
        $interlocuteur->mail=$inputs['mail'];
        $interlocuteur->commentaire=$inputs['commentaire'];
        //Récupération du type de fonction selon la liste déroulante
        switch ($inputs['type']) {
          case 1:
            $interlocuteur->type='Opérationel';
            break;
          case 2:
            $interlocuteur->type='Ressources Humaines';
            break;
          case 3:
            $interlocuteur->type='Mission Handicap';
            break;
        }
        //Récupération de la civilité selon la liste déroulante
        switch ($inputs['civilite']) {
          case 0:
            $interlocuteur->civilite='M';
            break;
          case 1:
            $interlocuteur->civilite='Mme';
            break;
          case 2:
            $interlocuteur->civilite='Dr';
            break;
          case 3:
            $interlocuteur->civilite='Pr';
            break;
          case 4:
            $interlocuteur->civilite='Me';
            break;
        }
        //Enregsitrement de l'objet en base de données
    		$interlocuteur->save();
        //Si des entreprises sont selectionnés mise en place du lien entreprises et interlocuteur
        if(isset($inputs['entreprises'])){
            $entreprises_id = $inputs['entreprises'];
            //Remplissage d'un tableau avec une date générique pour différencier les vrai contacts des contacts servant à ajouter un interlocuteur à une entreprise
            $pivot = array_fill(0,count($entreprises_id),['date'=>date_create('01/01/1000')]);
            //Combinaison des 2 tableaux
            $sync = array_combine($entreprises_id,$pivot);
            //Mise en place du lien entre l'interlocuteur et les entreprises
            $interlocuteur->entreprises()->sync($sync);
        }
        //Appel à la fonction d'enregistrement d'un evenement sur le fiche de l'interlocuteur
        $this->interlocuteurEventRepository->store([$inputs['utilisateur'],
                                                 $inputs['date'],
                                                 $inputs['nature'],
                                                 $inputs['commentaireEvent'],
                                                 $interlocuteur->id]);
  	}

    //Fonction de récupération des interlocuteurs triés par ordres alphabétique sur le nom
  	public function getInterlocuteurs()
  	{
  		  return $this->interlocuteur->orderBy('nom','asc')->get();
  	}

    //Récupération des interlocuteurs qui appartiennent à une entreprise (id fourni)
    //triés par ordre alphabétique sur le nom
    public function getInterlocuteursByEntreprise($id)
  	{
  		  return $this->interlocuteur->join('contacts','interlocuteurs.id','=','contacts.interlocuteur_id')
                                    ->where('contacts.entreprise_id','=',$id)
                                    ->orderBy('nom','asc')
                                    ->get();
  	}

    //Fonction de récupération des adresses mail d'une collection d'unterlocuteurs
    public function getInterlocuteursMail($interlocuteurs)
  	{
        $mails=array();
        //Parcours les objets interlocuteurs
        foreach ($interlocuteurs as $interlocuteur) {
          //Récupère les mails
          $mails[]=$interlocuteur->mail;
        }
        //Retourne la liste des mails
        return $mails;
  	}

    //Fonction d'enregistrement d'un interlocuteur
  	public function store(Array $inputs)
  	{
        //Création d'un onjet interlocuteur
    		$interlocuteur = new $this->interlocuteur;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$this->save($interlocuteur, $inputs);
        //Retourne l'interlocuteur
    		return $interlocuteur;
  	}

    //Fonction de récupération d'un interlocuteur selon l'id
  	public function getById($id)
  	{
    		return $this->interlocuteur->findOrFail($id);
  	}

  	public function update($id, Array $inputs)
  	{
  		  $this->save($this->getById($id), $inputs);
  	}

    //Fonction de suppression d'un interlocuteur
  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    //Fonction de recherche d'un interlocuteur
    public function search(Array $inputs)
  	{
        //Si le l'option choisie n'est pas 'Tous type' on réduit les interlocuteurs possibles
        if($inputs['type']!=0){
            //On récupère le titre sous forme de chaine de caractères pour la requête
            switch($inputs['type']){
              case 1:
                $type='Opérationel';
                break;
              case 2:
                $type='Ressources Humaines';
                break;
              case 3:
                $type='Mission Handicap';
                break;
            }
            $entree=$inputs['int'];
            //Récupération des interlocuteurs correspondant à la recherche triés alphabétiquement par nom
            $tabInterlocuteurs= $this->interlocuteur->where('type','=',$type)
                                                    ->where(function($q) use ($entree){
                                                      //mise du chere sous forme de fonction pour mettre tout le bloc dans un AND ( OR OR )
                                                      $q->whereRaw("CONCAT( prenom ,' ', nom ) LIKE '%".$entree."%'")
                                                        ->orWhere('nom','like','%'.$entree.'%')
                                                        ->orWhere('prenom','like','%'.$entree.'%');
                                                    })
                                                    ->orderBy('nom','asc')
                                                    ->get();
        }
        else{
            //Si 'Tous types' est choisi on renvoi les résultats de la recherche pour n'importe quel type
            $tabInterlocuteurs= $this->interlocuteur->whereRaw("CONCAT( prenom ,' ', nom ) LIKE '%".$inputs['int']."%'")
                                                  ->orWhere('nom','like','%'.$inputs['int'].'%')
                                                  ->orWhere('prenom','like','%'.$inputs['int'].'%')
                                                  ->orderBy('nom','asc')
                                                  ->get();
        }
        //Si la limitation aux partenaires réguliers est activé on tri la liste des résultats
        if($inputs['limiteInt']=='true'){
            $interlocuteurs=array();
            //On parcours pour chaque interlocuteur les entreprises
            foreach($tabInterlocuteurs as $interlocuteur){
                foreach($interlocuteur->entreprises as $entreprise){
                    if($entreprise->partenaireRegulier){
                        //Si l'entreprise est partenaire régulier et l'interlocuteur n'est pas déjà dans la liste on l'ajotue à la liste des interlocuteurs à retourner
                        if(!in_array($interlocuteur,$interlocuteurs)){
                            $interlocuteurs[]=$interlocuteur;
                        }
                    }
                }
            }
            //On retourne le résultat de la requête limité au partenaires réguliers
            return $interlocuteurs;
        }
        else{
            //On retourne le résultat de la requête
            return $tabInterlocuteurs;
        }
  	}

}
