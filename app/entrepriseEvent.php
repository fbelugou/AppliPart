<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntrepriseEvent extends Model
{
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

    public function entreprises()
  	{
  		return $this->belongsTo('App\entreprise');
  	}


}
