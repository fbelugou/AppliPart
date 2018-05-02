<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
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

    public function entreprises()
  	{
  		return $this->belongsToMany('App\entreprise');
  	}
}
