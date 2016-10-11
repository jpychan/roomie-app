<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User', 'lender_id');
  }

  public function fractions()
  {
    return $this->hasMany('App\ExpenseFraction');
  }

  public function creator()
  {
    return $this->belongsTo('App\User', 'creator_id');
  }

  public function lender()
  {
    return $this->belongsTo('App\User', 'lender_id');
  }

  public function group()
  {
    return $this->belongsTo('App\Group', 'group_id');
  }

  protected $fillable = [
    'name', 'creator_id', 'lender_id', 'group_id', 'total_cents'
  ];

}
