<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['name', 'icon'];
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}