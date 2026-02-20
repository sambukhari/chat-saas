<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportEvent extends Model
{
    protected $fillable = [
        'company_id',
        'conversation_id',
        'type',
        'payload'
    ];

    protected $casts = [
        'payload' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}