<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departemen';
    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
