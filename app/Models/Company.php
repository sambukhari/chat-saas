<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    protected $fillable = ['name','email','password','plan','is_active'];
    protected $hidden = ['password'];

    public function agents() { return $this->hasMany(Agent::class); }
    public function sites() { return $this->hasMany(CompanySite::class); }
    public function conversations() { return $this->hasMany(Conversation::class); }
}
