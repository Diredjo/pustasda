<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    protected $fillable = ['user_id', 'nip', 'bidang_keahlian', 'jabatan'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}