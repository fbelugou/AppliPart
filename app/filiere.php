<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    public $table = "filieres";
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'metier',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 'remember_token',
    ];

    //Retourne les entreprises en lien avec la filière
    public function entreprises()
  	{
  		return $this->belongsToMany('App\Entreprise');
  	}
}
