<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model {

    protected $table = 'visitas';
    public $timestamps = false;

    protected $guarded = [
        'ID_URL'
    ];
}
