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
      'contactAMIO','date','objet','commentaire',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'interlocuteur_id', 'entreprise_id',
    ];

    public function entreprise()
  	{
  		return $this->hasOne('App\Entreprise');
  	}

    public function interlocuteur()
  	{
  		return $this->hasOne('App\Interlocuteur');
  	}
}
