<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Mentorship extends Model
{
    protected $fillable = ['participation_id', 'teacher_id', 'status', 'responded_at'];
    protected $casts = ['responded_at' => 'datetime'];
    public function participation()
    {
        return $this->belongsTo(Participation::class);
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}