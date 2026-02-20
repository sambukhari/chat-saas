<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'uuid',
        'company_id',
        'site_id',
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'status',
        'assigned_agent_id',
        'unread_count'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function site()
    {
        return $this->belongsTo(CompanySite::class, 'site_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }
}