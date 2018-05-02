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

    public function entreprise()
  	{
  		return $this->belongsTo('App\entreprise');
  	}
}
