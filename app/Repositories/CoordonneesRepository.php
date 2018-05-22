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

  	private function save(Coordonnees $coordonnees, Array $inputs)
  	{
        $coordonnees->nom=$inputs['nom'];
        $coordonnees->taille=$inputs['taille'];

    		$coordonnees->save();
  	}

  	public function getCoordonneess()
  	{
  		  return $this->coordonnees->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$coordonnees = new $this->coordonnees;

    		$this->save($coordonnees, $inputs);

    		return $coordonnees;
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
