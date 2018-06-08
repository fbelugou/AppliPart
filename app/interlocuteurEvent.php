<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class InterlocuteurEvent extends Model
{
    public $table = "interlocuteurevents";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'utilisateur','date','nature','commentaire',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    //Retourne l'interlocuteur en lien avec l'évenement
    public function interlocuteur()
  	{
  		return $this->hasOne('App\Interlocuteur');
  	}
}
