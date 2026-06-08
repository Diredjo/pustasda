<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'kelas',
        'jurusan',
        'angkatan',
        'bio_ai',
        'preferences',
        'privacy_profile',
        'allow_team_invite',
        'notification_pref',
    ];

    protected $casts = [
        'preferences' => 'array',
        'allow_team_invite' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}