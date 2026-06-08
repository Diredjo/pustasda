<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'competition_id',
        'leader_id',
        'team_name',
        'invite_code',
        'status',
        'is_public',
    ];

    protected $casts = ['is_public' => 'boolean'];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
    public function acceptedMembers()
    {
        return $this->hasMany(TeamMember::class)->where('status', 'accepted');
    }
}