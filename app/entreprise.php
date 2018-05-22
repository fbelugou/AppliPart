<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    public $table = "entreprises";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'nom','partenaireRegulier','siegeSocial','taille','rue','ville','cp','siteWeb','telephone','commentaire','groupe_id','coord_id',
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
  		return $this->hasMany('App\Action');
  	}

    public function evenements()
  	{
  		return $this->hasMany('App\EntrepriseEvent','entrepriseEvents');
  	}

    public function activites()
  	{
  		return $this->belongsToMany('App\Activite','entreprises_activites');
  	}

    public function filieres()
  	{
  		return $this->belongsToMany('App\Filiere','entreprises_filieres');
  	}

    public function interlocuteurs()
  	{
  		return $this->belongsToMany('App\Interlocuteur','contacts')->withPivot('id','contactAMIO','date','objet','commentaire');
  	}

    public function coordonnees()
  	{
  		return $this->hasOne('App\Coordonnees');
  	}

    public function groupe()
  	{
  		return $this->belongsTo('App\Groupe');
  	}
}
