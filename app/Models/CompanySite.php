<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySite extends Model
{
    protected $fillable = ['company_id','domain','widget_key','is_active'];

    public function company() { return $this->belongsTo(Company::class); }

    public function conversations() { return $this->hasMany(Conversation::class); }
}
