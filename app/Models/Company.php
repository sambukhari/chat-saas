<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'ai_enabled',
        'plan',
        'is_active'
    ];

    public function sites()
    {
        return $this->hasMany(CompanySite::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
