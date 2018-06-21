<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table = "contacts";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'contactAMIO','date','nature','commentaire',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'interlocuteur_id', 'entreprise_id',
    ];

    //Retourne l'entreprise en lien avec le contact
    public function entreprise()
  	{
  		return $this->hasOne('App\Entreprise');
  	}

    //Retourne l'interlocuteur en lien avec le contact
    public function interlocuteur()
  	{
  		return $this->hasOne('App\Interlocuteur');
  	}
}
