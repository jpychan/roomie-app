<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
  protected $fillable = [
    'role', 'group_id', 'user_id'
  ];
}
