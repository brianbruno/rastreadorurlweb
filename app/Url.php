<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model {
  
    protected $table = 'url';
    public $timestamps = false;
    
    protected $guarded = [
        'URL', 'ID_ORIGEM'
    ];

  
}
