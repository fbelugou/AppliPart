<?php

namespace App\Repositories;

use App\Entreprise;
use App\Repositories\GroupeRepository;
use App\Repositories\CoordonneesRepository;
use App\Repositories\EntrepriseEventRepository;

class EntrepriseRepository
{

    protected $entreprise;
    protected $groupeRepository;
    protected $coordonneesRepository;
    protected $entrepriseEventRepository;

    public function __construct(Entreprise $entreprise,
                                GroupeRepository $groupeRepository,
                                coordonneesRepository $coordonneesRepository,
                                EntrepriseEventRepository $EER)
  	{
  		  $this->entreprise = $entreprise;
        $this->groupeRepository = $groupeRepository;
        $this->coordonneesRepository = $coordonneesRepository;
        $this->entrepriseEventRepository = $EER;
  	}

    //Fonction d'enregistrement en base de données d'une entreprise
  	private function save(Entreprise $entreprise, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans l'objet entreprise fourni
        $entreprise->nom=$inputs['nom'];
        $entreprise->partenaireRegulier=isset($inputs['partenaireRegulier']);
        $entreprise->siegeSocial=isset($inputs['siegeSocial']);
        $entreprise->taille=$inputs['taille'];
        $entreprise->adresse1=$inputs['adresse1'];
        $entreprise->adresse2=$inputs['adresse2'];
        $entreprise->ville=$inputs['ville'];
        $entreprise->cp=$inputs['cp'];
        $entreprise->siteWeb=$inputs['siteWeb'];
        $entreprise->telephone=$inputs['telephone'];
        $entreprise->commentaire=$inputs['commentaire'];
        //Ajoute le groupe si il est défini
        if($inputs['groupe']!=0){
            $entreprise->groupe_id=$inputs['groupe'];
        }
        else{
            $entreprise->groupe_id=null;
        }
        //Mise en forme de l'adresse pour encodage GPS
        $adresse = $entreprise->adresse1.' '.$entreprise->cp.' '.$entreprise->ville;
        //Appel à la fonction d'enregistrement de coordonnées GPS
        $resultat=$this->coordonneesRepository->store($adresse);
        //Si la fonction à marcher mise en place du lien avec l'objet coordonnées
        if($resultat[1]){
            $entreprise->coordonnees_id=$resultat[0]->id;
        }
        //Enregistrement de l'objet entreprise en base de données
        $entreprise->save();
        //Si des activités on été choisies mise en place du lien entre activités et l'entreprise
        if(isset($inputs['activites'])){
            $entreprise->activites()->sync($inputs['activites']);
        }
        //Si des filieres on été choisies mise en place du lien entre filieres et l'entreprise
        if(isset($inputs['filieres'])){
            $entreprise->filieres()->sync($inputs['filieres']);
        }
        //Si des interlocuteurs on été choisis mise en place du lien entre activités et l'entreprise
        if(isset($inputs['interlocuteurs'])){
            //Remplissage d'un tableau avec les identifiants des interlocuteurs
            $interlocuteurs_id = $inputs['interlocuteurs'];
            //Remplissage d'un tableau avec une date générique pour différencier les vrai contacts des contacts servant à ajouter un interlocuteur à une entreprise
            $pivot = array_fill(0,count($interlocuteurs_id),['date'=>date_create('01/01/1000')]);
            //Combinaison des 2 tableaux
            $sync = array_combine($interlocuteurs_id,$pivot);
            //Mise en place du lien entre les interlocuteurs et l'entreprise
            $entreprise->interlocuteurs()->sync($sync);
        }
        //Appel à une fonction d'enregsitrement d'un evenement sur la fiche de l'entreprise
        $this->entrepriseEventRepository->store([$inputs['utilisateur'],
                                                 $inputs['date'],
                                                 $inputs['nature'],
                                                 $inputs['commentaireEvent'],
                                                 $entreprise->id]);
  	}

    //Fonction de récupération des entreprises triées par ordre alphabétique sur le nom
    public function getEntreprises()
  	{
  		  return $this->entreprise->orderBy('nom','asc')->get();
  	}

    //Fonction de récupérations des entreprises partenaires réguliers triées par ordre alphabétiquement sur le nom
    public function getPartenaires()
  	{
  		  return $this->entreprise->where('partenaireRegulier','=',1)->orderBy('nom','asc')->get();
  	}

    //Fonction d'enregistrement d'une entreprise
  	public function store(Array $inputs)
  	{
        //Création d'une objet entreprise
    		$entreprise = new $this->entreprise;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$this->save($entreprise, $inputs);
        //Retourne l'entreprise
    		return $entreprise;
  	}

    //Fonction de récupération d'une entreprise selon l'id
  	public function getById($id)
  	{
    		return $this->entreprise->findOrFail($id);
  	}

    //Fonction de mise à jour d'une entreprise
  	public function update($id, Array $inputs)
  	{
        //Récupération d'une entreprise
        $ent=$this->getById($id);
        if(!is_null($ent->coordonnees)){
            //Si les coordonnées de l'entreprise sont enregistré on supprime l'objet coordonées
            $ent->coordonnees->delete();
        }
        //Appel à la fonction de sauvegarde en base de données de l'entreprise
  		  $this->save($ent, $inputs);
  	}

    //Fonction de suppression d'une entreprise en base de données
    public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    //Fonction de recherche d'une entreprise en base de données
    public function search(Array $inputs)
  	{
        //Si la limitation au entreprises régulières est activé alors on limite les entreprises et on effectue la recherche
        if($inputs['limiteEnt'] == "true"){
            return $this->entreprise->where('nom','like','%'.$inputs['ent'].'%')->where('partenaireRegulier','=',1)->get();
        }
        else{
            return $this->entreprise->where('nom','like','%'.$inputs['ent'].'%')->get();
        }
  	}

    //Fonction de recherche d'entreprises par rapport à une distance à une ville
    public function searchDist(Array $inputs)
  	{
        //Si la limitation aux entreprises régulières est activé on limite les entreprises
        if($inputs['limiteEntDist'] == "true"){
            $tabEntreprises = $this->entreprise->where('partenaireRegulier','=',1)->get();
        }
        else{
            $tabEntreprises = $this->entreprise->get();
        }
        $entreprises=array();
        //Encodage GPS des coordonées de la ville ou adresse fournie
        $resultat = $this->coordonneesRepository->geocode($inputs['ville']);
        if($resultat[0]){
            //Si l'appel à fonctionné on récupère les coordonnées de la ville et on les transforme afin de calculer la distance
            $longVille = $resultat[1][1]*(M_PI/180);
            $latVille  = $resultat[1][0]*(M_PI/180);
            //Test pour chacune des entreprises si la distance inférieure à la distance souhaitée
            foreach ($tabEntreprises as $entreprise) {
                //Vérification si l'entreprise à des coordonées
                if(isset($entreprise->coordonnees)){
                    //Encodage des coordonnées pour le calcul
                    $longEnt = $entreprise->coordonnees->longitude*(M_PI/180);
                    $latEnt  = $entreprise->coordonnees->latitude *(M_PI/180);
                    //Préparation au calcul de distance
                    $subEntVille = bcsub($longEnt, $longVille, 20);
                    $cosLatVille = cos($latVille);
                    $cosLatEnt   = cos($latEnt);
                    $sinLatVille = sin($latVille);
                    $sinLatEnt   = sin($latEnt);
                    //Calcul de distance
                    $distance = 6371*acos($cosLatVille*$cosLatEnt*cos($subEntVille)+$sinLatVille*$sinLatEnt);
                    //Si l'entreprise respecte la distance on l'ajout à un tableau d'entreprises
                    if($distance<=$inputs['dist']){
                      $entreprises[]=$entreprise;
                    }
                }
            }
            //Retourne l'etat de succes et les entreprises trouvés
            return ['etat'=>true,'entreprises'=>$entreprises];
        }
        elseif(isset($resultat[1])){
            //Si un message d'erreur est fournis on affiche un message en français
            return ['etat'=>false,'message'=>'Ville introuvable ou nombre maximum de requêtes dépassé'];
        }
  	}

    //Fonction de vérification si celà fait plus de 3 ans qu'il n'y as pas eu de contacts avec l'entreprise
    //Elle est retirée de la liste des partenaires réguliers
    //Cette fonction est apellée tout les 1er du mois à 10h du matin
    public function checkPartenaires(){
        //Récupération des partenaires réguliers
        $entreprises=$this->entreprise->where('partenaireRegulier','=',1)->orderBy('nom','asc')->get();

        foreach($entreprises as $entreprise){
            //Récupération de la date du dernier contact avec l'entreprise
            $dernierContact=dernierContact($entreprise);
            //Si l'entreprise à eu des actions avec AMIO on récupère la dernière date de la dernière action
            if(null !== $entreprise->actions->first()){
                $derniereAction=date_create($entreprise->actions->first()->date);
            }
            else{
                $derniereAction=null;
            }
            //La dernière intéraction est la date la plus récente entre le dernier contact er la dernière action
            $derniereInteraction=min($dernierContact,$derniereAction);
            //Si cette date n'est pas nulle on la compare à la date du jour
            if(!empty($derniereInteraction)){
                //Récupération de la date du jour
                $dateJour=\Carbon\Carbon::now();
                //Si l'écart entre les 2 dates est supérieur ou égal à 3 ans on change l'état de l'entreprise
                if(strval($dateJour->diff($derniereInteraction)->format('%y'))>=3){
                    //Changement de l'état de partenaireRegulier de l'entreprise
                    $entreprise->partenaireRegulier=0;
                    //Enregistrement de l'entreprise
                    $entreprise->save();
                }
            }
        }
        //Renvoi un message de succès dans le cas ou l'opération est appelée via une ligne de commande
        echo 'Opération terminée';
    }

    //Fonction de récupération d'une liste de mails d'entreprises
    public function listeMail(array $inputs)
    {
        $mails=array();
        //Parcours des éléments du formulaire selon les id des entreprises(array_keys) sans le premier éléments qui est le token de sécurité
        foreach(array_slice(array_keys($inputs),1) as $key=>$item){
            //récupération de l'entreprise
            $entreprise=$this->getById($item);
            //Parcours de tout les interlocuteurs qui on travaillé dans l'entreprise
            foreach($entreprise->interlocuteurs as $interlocuteur){
                //Si les interlocuteurs de l'entreprises travaillent toujours dans cette entreprise on récupère leurs mails
                if($interlocuteur->entreprisesDate->first()->id==$entreprise->id){
                    $mails[]=$interlocuteur->mail;
                }
            }
        }
        //Retourne le tableau de mails
        return $mails;
    }
}
