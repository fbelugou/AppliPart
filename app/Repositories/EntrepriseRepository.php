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

  	private function save(Entreprise $entreprise, Array $inputs)
  	{
        $entreprise->nom=$inputs['nom'];
        $entreprise->partenaireRegulier=isset($inputs['partenaireRegulier']);
        $entreprise->siegeSocial=isset($inputs['siegeSocial']);
        $entreprise->taille=$inputs['taille'];
        $entreprise->rue=$inputs['rue'];
        $entreprise->ville=$inputs['ville'];
        $entreprise->cp=$inputs['cp'];
        $entreprise->siteWeb=$inputs['siteWeb'];
        $entreprise->telephone=$inputs['telephone'];
        $entreprise->commentaire=$inputs['commentaire'];

        if($inputs['groupe']!=0){
            $entreprise->groupe_id=$inputs['groupe'];
        }
        else{
            $entreprise->groupe_id=null;
        }
        $adresse = $entreprise->rue.' '.$entreprise->cp.' '.$entreprise->ville;
        $resultat=$this->coordonneesRepository->store($adresse);
        if($resultat[1]){
            $entreprise->coordonnees_id=$resultat[0]->id;
        }
        $entreprise->save();
        if(isset($inputs['activites'])){
            $entreprise->activites()->sync($inputs['activites']);
        }
        if(isset($inputs['filieres'])){
            $entreprise->filieres()->sync($inputs['filieres']);
        }
        if(isset($inputs['interlocuteurs'])){
            $interlocuteurs_id = $inputs['interlocuteurs'];
            $pivot = array_fill(0,count($interlocuteurs_id),['date'=>date_create('01/01/1000')]);
            $sync = array_combine($interlocuteurs_id,$pivot);
            $entreprise->interlocuteurs()->sync($sync);
        }

        $this->entrepriseEventRepository->store([$inputs['utilisateur'],
                                                 $inputs['date'],
                                                 $inputs['nature'],
                                                 $inputs['commentaireEvent'],
                                                 $entreprise->id]);
  	}

    public function getEntreprises()
  	{
  		  return $this->entreprise->orderBy('nom','asc')->get();
  	}

    public function getPartenaires()
  	{
  		  return $this->entreprise->where('partenaireRegulier','=',1)->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$entreprise = new $this->entreprise;

    		$this->save($entreprise, $inputs);

    		return $entreprise;
  	}

  	public function getById($id)
  	{
    		return $this->entreprise->findOrFail($id);
  	}

  	public function update($id, Array $inputs)
  	{
        $ent=$this->getById($id);
        if(!is_null($ent->coordonnees)){
            $ent->coordonnees->delete();
        }
  		  $this->save($ent, $inputs);
  	}

    public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    public function search(Array $inputs)
  	{
        if($inputs['limiteEnt'] == "true"){
            return $this->entreprise->where('nom','like','%'.$inputs['ent'].'%')->where('partenaireRegulier','=',1)->get();
        }
        else{
            return $this->entreprise->where('nom','like','%'.$inputs['ent'].'%')->get();
        }
  	}

    public function searchDist(Array $inputs)
  	{
        if($inputs['limiteEntDist'] == "true"){
            $tabEntreprises = $this->entreprise->where('partenaireRegulier','=',1)->get();
        }
        else{
            $tabEntreprises = $this->entreprise->get();
        }
        $resultat = $this->coordonneesRepository->geocode($inputs['ville']);

        if($resultat[0]){
            $longVille    = $resultat[1][1]*(M_PI/180);
            $latVille     = $resultat[1][0]*(M_PI/180);

            foreach ($tabEntreprises as $entreprise) {
                if(isset($entreprise->coordonnees)){
                    $longEnt = $entreprise->coordonnees->longitude*(M_PI/180);
                    $latEnt  = $entreprise->coordonnees->latitude*(M_PI/180);

                    $subEntVille   = bcsub ($longEnt, $longVille, 20);
                    $cosLatVille = cos($latVille);
                    $cosLatEnt = cos($latEnt);
                    $sinLatVille = sin($latVille);
                    $sinLatEnt = sin($latEnt);

                    $distance = 6371*acos($cosLatVille*$cosLatEnt*cos($subEntVille)+$sinLatVille*$sinLatEnt);

                    if($distance<=$inputs['dist']){
                      $entreprises[]=$entreprise;
                    }
                }
            }
            return ['etat'=>true,'entreprises'=>$entreprises];
        }
        elseif(isset($resultat[1])){
            return ['etat'=>false,'message'=>'Ville introuvable ou nombre maximum de requêtes dépassé'];
        }
  	}

    public function checkPartenaires(){
        $entreprises=$this->entreprise->where('partenaireRegulier','=',1)->orderBy('nom','asc')->get();

        foreach($entreprises as $entreprise){
            $dernierContact=dernierContact($entreprise);
            //dd($entreprise->actions->first());
            if(null !== $entreprise->actions->first()){
                $derniereAction=date_create($entreprise->actions->first()->date);
            }
            else{
                $derniereAction=null;
            }
            $derniereInteraction=min($dernierContact,$derniereAction);
            if(!empty($derniereInteraction)){
                $dateJour=\Carbon\Carbon::now();
                if(strval($dateJour->diff($derniereInteraction)->format('%d'))>=3){
                    $entreprise->partenaireRegulier=0;
                    $entreprise->save();
                }
            }
        }
        echo 'Opération terminée';
    }

    public function listeMail(array $inputs)
    {
        $mails=array();
        foreach(array_slice(array_keys($inputs),2) as $key=>$item){
            $entreprise=$this->getById($item);
            foreach($entreprise->interlocuteurs as $interlocuteur){
                if($interlocuteur->entreprisesDate->first()->id==$entreprise->id){
                    $mails[]=$interlocuteur->mail;
                }
            }
        }
        return $mails;
    }
}
