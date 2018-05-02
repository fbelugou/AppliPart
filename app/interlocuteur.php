<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interlocuteur extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'prenom','nom','fonction','telFixe','telMobile','mail','commentaire','transmission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    public function evenements()
  	{
  		return $this->hasMany('App\interlocuteurEvenement');
  	}


    public function entreprises()
  	{
  		return $this->belongsToMany('App\entreprise')->pivot('contactAMIO','date','objet','commentaire');
  	}
}
