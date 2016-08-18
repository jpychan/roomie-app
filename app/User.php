<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public function loans()
    {
        return $this->hasMany('App\Expense', 'lender_id');
    }

    public function groups()
    {
        return $this->hasManyThrough('App\Group', 'App\Membership');
    }

    public function memberships()
    {
        return $this->hasMany('App\Membership');
    }

    public function debts()
    {
        return $this->hasMany('App\ExpenseFraction', 'borrower_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
