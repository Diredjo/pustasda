<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
        'wa_number',
        'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function teacherProfile()
    {
        return $this->hasOne(TeacherProfile::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }

    public function savedCompetitions()
    {
        return $this->hasMany(CompetitionSave::class);
    }

    public function saveFolders()
    {
        return $this->hasMany(SaveFolder::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')->withPivot('earned_at');
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    public function isDeveloper(): bool
    {
        return $this->role === 'developer';
    }

    public function getPhotoUrlAttribute(): string
    {
        return asset('images/avatars/' . ($this->photo ?? 'default-avatar.png'));
    }
}