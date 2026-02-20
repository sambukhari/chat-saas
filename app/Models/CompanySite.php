<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanySite extends Model
{
    protected $fillable = [
        'company_id',
        'domain',
        'widget_key',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($site) {
            if (!$site->widget_key) {
                $site->widget_key = Str::random(40);
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'site_id');
    }
}