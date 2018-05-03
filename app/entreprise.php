<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'nom','partenaireRegulier','siegeSocial','adresse','taille','rue','ville','cp','siteWeb','telephone','commentaire','groupe_id','event_id','coord_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    public function actions()
  	{
  		return $this->hasMany('App\action');
  	}

    public function evenements()
  	{
  		return $this->hasMany('App\entrepriseEvenement');
  	}

    public function activites()
  	{
  		return $this->belongsToMany('App\activite');
  	}

    public function filieres()
  	{
  		return $this->belongsToMany('App\filiere');
  	}

    public function interlocuteurs()
  	{
  		return $this->belongsToMany('App\interlocuteur')->withPivot('contactAMIO','date','objet','commentaire');
  	}

    public function coordonnees()
  	{
  		return $this->hasOne('App\coordonnees');
  	}
}
