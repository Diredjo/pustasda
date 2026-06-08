<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CompetitionSave extends Model
{
    protected $fillable = ['user_id', 'competition_id', 'folder_id'];
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function folder()
    {
        return $this->belongsTo(SaveFolder::class);
    }
}