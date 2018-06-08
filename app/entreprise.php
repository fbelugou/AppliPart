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

    //Retourne les actions de l'entreprise avec l'association de la plus récente à la plus ancienne
    public function actions()
  	{
  		return $this->hasMany('App\Action')->orderBy('date','desc');
  	}

    //Retourne les évenements en lien avec l'entreprise (création, modification, ...) de la plus récente à la plus ancienne
    public function evenements()
  	{
  		return $this->hasMany('App\EntrepriseEvent')->orderBy('date','desc');
  	}

    //Retourne les activités de l'entreprise
    public function activites()
  	{
  		return $this->belongsToMany('App\Activite','entreprises_activites');
  	}

    //Retourne les métiers présent dans l'entreprise
    public function filieres()
  	{
  		return $this->belongsToMany('App\Filiere','entreprises_filieres');
  	}

    //Retourne les interlocuteurs qui ont travaillé ou qui travaillent encore pour l'entrepriseavec les données de la table associative
    public function interlocuteurs()
  	{
  		return $this->belongsToMany('App\Interlocuteur','contacts')->withPivot('id','contactAMIO','date','objet','commentaire');
  	}

    //Retourne les coordonnées GPS de l'entreprise
    public function coordonnees()
  	{
  		return $this->belongsTo('App\Coordonnees');
  	}

    //Retourne le groupe de l'entreprise
    public function groupe()
  	{
  		return $this->belongsTo('App\Groupe');
  	}
}
