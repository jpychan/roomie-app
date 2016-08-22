<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public function group()
    {
      return $this->belongsTo('App\Group');
    }

    public function users()
    {
      return $this->belongsTo('App\User');
    }
}
