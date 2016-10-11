<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseFraction extends Model
{
    public function expense()
    {
    return $this->belongsTo('App\Expense');
    }

    public function borrower()
    {
      return $this->belongsTo('App\User', 'borrower_id');
    }

  protected $fillable = [
    'expense_id', 'borrower_id', 'amount_owed_cents'
  ];
}