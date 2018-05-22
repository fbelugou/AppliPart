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

  	private function save(Contact $contact, Array $inputs)
  	{
        //$user->roles()->sync(array(1 => array('expires' => true)));
        $contact->contactAMIO=$inputs['contactAMIO'];
        $contact->date=date_create($inputs['date']);
        $contact->entreprise_id=$inputs['entreprise'];
        $contact->objet=$inputs['objet'];
        $contact->interlocuteur_id=$inputs['interlocuteur'];
        $contact->commentaire=$inputs['commentaire'];

    		$contact->save();
  	}

  	public function getContacts()
  	{
  		  return $this->contact->orderBy('nom','asc')->get();
  	}

  	public function store(Array $inputs)
  	{
    		$contact = new $this->contact;

    		$this->save($contact, $inputs);

    		return $contact;
  	}

  	public function getById($id)
  	{
    		return $this->contact->findOrFail($id);
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
