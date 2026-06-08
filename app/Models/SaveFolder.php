<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SaveFolder extends Model
{
    protected $fillable = ['user_id', 'name', 'icon'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function saves()
    {
        return $this->hasMany(CompetitionSave::class, 'folder_id');
    }
}