<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CompetitionStage extends Model
{
    protected $fillable = ['competition_id', 'stage_number', 'stage_name', 'deadline', 'description'];
    protected $casts = ['deadline' => 'date'];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}