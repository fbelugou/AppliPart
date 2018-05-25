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

  	private function save(Groupe $groupe, Array $inputs)
  	{
        $groupe->nom=$inputs['nom'];
        $groupe->taille=$inputs['taille'];

    		$groupe->save();
  	}

  	public function getGroupes()
  	{
  		  return $this->groupe->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$groupe = new $this->groupe;

    		$this->save($groupe, $inputs);

    		return $groupe;
  	}

  	public function getById($id)
  	{
    		return $this->groupe->findOrFail($id);
  	}

  	public function update($id, Array $inputs)
  	{
  		  $this->save($this->getById($id), $inputs);
  	}

  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

    public function search(Array $inputs)
    {
        if($inputs['limiteGrp']=='true'){
            $tabGroupes= $this->groupe->where('nom','like','%'.$inputs['grp'].'%')->orderBy('nom','asc')->get();
            $groupes=array();
            foreach($tabGroupes as $groupe){
                foreach($groupe->entreprises as $entreprise){
                    if($entreprise->partenaireRegulier){
                        if(!in_array($groupe,$groupes)){
                            $groupes[]=$groupe;
                        }
                    }
                }
            }
            return $groupes;
        }
        else{
            return $this->groupe->where('nom','like','%'.$inputs['grp'].'%')->orderBy('nom','asc')->get();
        }
    }

}
