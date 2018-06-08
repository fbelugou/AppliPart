<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    public $table = "activites";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'libelle',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    //Retourne les entreprises de cette activité
    public function entreprises()
  	{
  		return $this->belongsToMany('App\Entreprise');
  	}
}
