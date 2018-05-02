<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'nature','date','commentaire',
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
