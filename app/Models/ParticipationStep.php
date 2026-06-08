<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ParticipationStep extends Model
{
    protected $fillable = ['participation_id', 'step_name', 'step_order', 'is_confirmed', 'confirmed_at', 'notes'];
    protected $casts = ['is_confirmed' => 'boolean', 'confirmed_at' => 'datetime'];
    public function participation()
    {
        return $this->belongsTo(Participation::class);
    }
}