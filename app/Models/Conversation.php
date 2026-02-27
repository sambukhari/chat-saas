<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'company_id', 'uuid','company_site_id','status','assigned_agent_id',
        'visitor_name','visitor_email','assigned_user_id', 'handled_by', 'assigned_at', 'ai_started_at', 'unread_count'
    ];

    public function company() { return $this->belongsTo(Company::class); }
    public function site() { return $this->belongsTo(CompanySite::class, 'company_site_id'); }
    public function agent() { return $this->belongsTo(Agent::class, 'assigned_agent_id'); }
    public function messages() { return $this->hasMany(Message::class); }
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function events()
    {
        return $this->hasMany(ConversationEvent::class);
    }
}
