<?php

namespace App\Repositories;

use App\Entreprise;
use App\Repositories\GroupeRepository;
use App\Repositories\CoordonneesRepository;

class EntrepriseRepository
{

    protected $entreprise;
    protected $groupeRepository;
    protected $coordonneesRepository;

    public function __construct(Entreprise $entreprise,
                                GroupeRepository $groupeRepository,
                                coordonneesRepository $coordonneesRepository)
  	{
  		  $this->entreprise = $entreprise;
        $this->groupeRepository = $groupeRepository;
        $this->coordonneesRepository = $coordonneesRepository;
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
            $entreprise->interlocuteurs()->sync($inputs['interlocuteurs']);
        }
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

        if($resultat[1]){
            $longVille     = $resultat[1][1]*(M_PI/180);
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
            return $entreprises;
        }
        elseif(isset($resultat[1])){
            return view('Erreur',  ['message'=>$resultat[1]]);
        }
  	}

}
