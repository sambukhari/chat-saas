<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable
{
    protected $fillable = ['company_id','name','email','password','is_active'];
    protected $hidden = ['password'];

    public function company() { return $this->belongsTo(Company::class); }
}
