<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Coordonnees extends Model
{
    public $table = "coordonnees";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'lattitude','longitude',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    //Retourne l'entreprise en lien avec les coordonnées
    public function entreprise()
  	{
  		return $this->belongsTo('App\Entreprise');
  	}
}
