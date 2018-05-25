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

  	private function save(Coordonnees $coordonnees, $adresse)
  	{
        $reponse = $this->geocode($adresse);
        if($reponse[0]){
            $coordonnees->latitude=$reponse[1][0];
            $coordonnees->longitude=$reponse[1][1];
            $coordonnees->save();
            return true;
        }
        else{
            return $reponse;
        }
  	}

    function geocode($adresse){
        $adresse = urlencode($adresse);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$adresse}&key=AIzaSyDKqiesIRLrmUccoTVliXF5aGH9qUPuCgA";
        $resp_json = file_get_contents($url,false,stream_context_create(["ssl"=>["verify_peer"=>false,"verify_peer_name"=>false]]));
        $resp = json_decode($resp_json, true);
        if($resp['status']=='OK'){
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            if($lati && $longi && $formatted_address){
                $data_arr = array();
                array_push($data_arr,$lati,$longi,$formatted_address);
                return [true,$data_arr];
            }
            else{
                return [false];
            }
        }
        else{
            return [false,"Erreur: {$resp['status']}"];
        }
    }

  	public function store($adresse)
  	{
    		$coordonnees = new $this->coordonnees;

    		$res = $this->save($coordonnees, $adresse);

    		return [$coordonnees,$res];
  	}

  	public function getById($id)
  	{
    		return $this->coordonnees->findOrFail($id);
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
