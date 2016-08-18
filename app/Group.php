<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

  public function users()
    {
      return $this->hasManyThrough('App\User', 'App\Membership');
    }

  public function memberships()
    {
      return $this->hasMany('App\Membership');
    }

}
