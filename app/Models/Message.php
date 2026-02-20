<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'company_id',
        'conversation_id',
        'sender_type',
        'sender_id',
        'text'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}