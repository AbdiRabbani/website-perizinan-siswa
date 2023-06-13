<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = "izin";
    protected $guarded = [];

    public function departement()
    {
        return $this->belongsTo('App\Departement', 'id_departemen');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

}
