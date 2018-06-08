<?php

namespace App\Repositories;

use App\Coordonnees;

class CoordonneesRepository
{

    protected $coordonnees;

    public function __construct(Coordonnees $coordonnees)
  	{
  		  $this->coordonnees = $coordonnees;
  	}

    //Fonction d'enregistrement en base de données de coordonnées
  	private function save(Coordonnees $coordonnees, $adresse)
  	{
        //Appel à la fonction de code d'une adresse en coordonnées GPS
        $reponse = $this->geocode($adresse);
        if($reponse[0]){
            //Si l'appel à l'API à fonctionner on enregistre les coordonnées et on enregistre l'objet
            $coordonnees->latitude=$reponse[1][0];
            $coordonnees->longitude=$reponse[1][1];
            $coordonnees->save();
            return true;
        }
        else{
            //Si l'appel à l'API n'a pas fonctionné on retourne l'erreur
            return $reponse;
        }
  	}

    //Fonction d'encodage d'adresse en coordonnées GPS
    function geocode($adresse){
        //Encore la chaine de caractères pour être utilisé dans l'appel de l'API
        $adresse = urlencode($adresse);
        //Définition de l'adresse pour l'appel de l'API geocode de google
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$adresse}&key=AIzaSyDKqiesIRLrmUccoTVliXF5aGH9qUPuCgA";
        //Appel de l'API et récupération de la réponse
        $resp_json = file_get_contents($url,false,stream_context_create(["ssl"=>["verify_peer"=>false,"verify_peer_name"=>false]]));
        //Décodage de la réponse JSON
        $resp = json_decode($resp_json, true);
        //Vérification du status de la réponse
        if($resp['status']=='OK'){
            //Récupération de la lattitude et de la longitude et de l'adresse formatée
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            //Si les 3 éléments sont récupérés avec succès le résultat est retourne sinon retourne faux
            if($lati && $longi && $formatted_address){
                //Création du tableau
                $data_arr = array();
                //Remplissage du tableau
                array_push($data_arr,$lati,$longi,$formatted_address);
                //Retourne le succès de l'opération et les informations
                return [true,$data_arr];
            }
            else{
                return [false];
            }
        }
        else{
          //Retourne l'echec de l'opération et le message d'erreur
            return [false,"Erreur: {$resp['status']}"];
        }
    }

    //Fonction d'enregistrement de coordonnées
  	public function store($adresse)
  	{
        //Création d'un objet coordonnées
    		$coordonnees = new $this->coordonnees;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$res = $this->save($coordonnees, $adresse);
        //Retourne l'objet et la réponse (echec ou succès de l'encodage GPS)
    		return [$coordonnees,$res];
  	}

    //Fonction de récupération d'une action selon l'id
  	public function getById($id)
  	{
    		return $this->coordonnees->findOrFail($id);
  	}

    //Fonction de mise à jour de coordonnées
  	public function update($id, Array $inputs)
  	{
        //Récupère les coordonnées et apelle la méthode de sauvegarde en base de données du controlleur
  		  $this->save($this->getById($id), $inputs);
  	}

    //Fonction de suppression de coordonnées
  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

}
