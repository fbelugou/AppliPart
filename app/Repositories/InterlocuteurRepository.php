<?php

namespace App\Repositories;

use App\Interlocuteur;

class InterlocuteurRepository
{

    protected $interlocuteur;

    public function __construct(Interlocuteur $interlocuteur)
  	{
  		  $this->interlocuteur = $interlocuteur;
  	}

  	private function save(Interlocuteur $interlocuteur, Array $inputs)
  	{
        $interlocuteur->prenom=$inputs['prenom'];
        $interlocuteur->nom=$inputs['nom'];
        $interlocuteur->transmission=isset($inputs['transmission']);
        $interlocuteur->fonction=$inputs['fonction'];
        $interlocuteur->telFixe=$inputs['telFixe'];
        $interlocuteur->telMobile=$inputs['telMobile'];
        $interlocuteur->mail=$inputs['mail'];
        $interlocuteur->commentaire=$inputs['commentaire'];

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

    		$interlocuteur->save();
        if(isset($inputs['entreprises'])){
            $interlocuteur->entreprises()->sync($inputs['entreprises']);
        }
  	}

  	public function getInterlocuteurs()
  	{
  		  return $this->interlocuteur->orderBy('nom','asc')->get();
  	}

    public function getInterlocuteursId()
  	{
  		  return $this->interlocuteur->orderBy('id','asc')->get();
  	}

    public function getInterlocuteursMail()
  	{
        $interlocuteurs=$this->interlocuteur->orderBy('mail','asc')->get();
        foreach ($interlocuteurs as $interlocuteur) {
          $mails[]=$interlocuteur->mail;
        }
        return $mails;
  	}

  	public function store(Array $inputs)
  	{
    		$interlocuteur = new $this->interlocuteur;

    		$this->save($interlocuteur, $inputs);

    		return $interlocuteur;
  	}

  	public function getById($id)
  	{
    		return $this->interlocuteur->findOrFail($id);
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
