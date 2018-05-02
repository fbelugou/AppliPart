<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'nom','taille',
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
  		return $this->hasMany('App\entreprise');
  	}
}
