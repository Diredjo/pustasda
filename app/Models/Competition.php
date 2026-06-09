<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'category_id',
        'field_id',
        'created_by',
        'title',
        'organizer',
        'level',
        'type',
        'max_members',
        'min_members',
        'description',
        'requirements',
        'link_registration',
        'guidebook_link',
        'poster',
        'cover',
        'register_deadline',
        'deadline',
        'announcement_date',
        'total_stages',
        'is_active',
        'is_trending',
        'view_count',
    ];

    protected $casts = [
        'deadline' => 'date',
        'register_deadline' => 'date',
        'announcement_date' => 'date',
        'is_active' => 'boolean',
        'is_trending' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function stages()
    {
        return $this->hasMany(CompetitionStage::class)->orderBy('stage_number');
    }
    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    public function saves()
    {
        return $this->hasMany(CompetitionSave::class);
    }

    public function isDeadlineSoon(): bool
    {
        return $this->deadline && $this->deadline->diffInDays(now()) <= 7 && $this->deadline->isFuture();
    }

    public function isTeamType(): bool
    {
        return $this->type === 'team';
    }
}