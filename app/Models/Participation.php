<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = [
        'user_id',
        'competition_id',
        'team_id',
        'status',
        'result',
        'current_stage',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function steps()
    {
        return $this->hasMany(ParticipationStep::class)->orderBy('step_order');
    }
    public function mentorship()
    {
        return $this->hasOne(Mentorship::class);
    }
}