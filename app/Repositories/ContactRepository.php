<?php

namespace App\Repositories;

use App\Contact;

class ContactRepository
{

    protected $contact;

    public function __construct(Contact $contact)
  	{
  		  $this->contact = $contact;
  	}

    //Fonction d'enregistrement en base de données d'un contact
  	private function save(Contact $contact, Array $inputs)
  	{
        //Récupération des informations des champs du formulaire et implementation dans l'objet contact fourni
        $contact->contactAMIO=$inputs['contactAMIO'];
        $contact->date=date_create($inputs['date']);
        $contact->entreprise_id=$inputs['entreprise'];
        $contact->nature=$inputs['nature'];
        $contact->interlocuteur_id=$inputs['interlocuteur'];
        $contact->commentaire=$inputs['commentaire'];
        //Enregistrement de l'objet en base de données
    		$contact->save();
  	}

    //Fonction de récupération des contacts
  	public function getContacts()
  	{
        //Retroune les contacts triés alphabétiquement sur le nom
  		  return $this->contact->orderBy('nom','asc')->get();
  	}

    //Fonction d'enrgistrement d'un contact
  	public function store(Array $inputs)
  	{
        //Création d'un contact
    		$contact = new $this->contact;
        //Appel à la méthode de sauvegarde en base de données du repository
    		$this->save($contact, $inputs);
        //retourne le contact créé
    		return $contact;
  	}

    //Fonction de récupération d'un contact selon l'id
  	public function getById($id)
  	{
    		return $this->contact->findOrFail($id);
  	}

    //Fonction de mise  jour d'un contact
  	public function update($id, Array $inputs)
  	{
        //Récupère un contact et appelle la méthode de sauvegarde en base de données du controlleur
        $this->save($this->getById($id), $inputs);
  	}

    //Fonction de suppression d'un contact
  	public function destroy($id)
  	{
  		  $this->getById($id)->delete();
  	}

}
