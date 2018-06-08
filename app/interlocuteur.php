<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Interlocuteur extends Model
{
    public $table = "interlocuteurs";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'prenom','nom','fonction','type','telFixe','telMobile','mail','commentaire','transmission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    //Retourne les évenements sur la fiche interlocuteur (Création, modification ...)
    public function evenements()
  	{
  		return $this->hasMany('App\InterlocuteurEvent');
  	}

    //Retourne la liste des entreprises avec les données de la table associative
    public function entreprises()
  	{
  		return $this->belongsToMany('App\Entreprise','contacts')->withPivot('contactAMIO','date','objet','commentaire');
  	}

    //Retourne les entreprises de la plus récente à la plus ancienne (par rapport au contact)
    public function entreprisesDate()
  	{
  		return $this->belongsToMany('App\Entreprise','contacts')->orderBy('date','desc');
  	}
}
