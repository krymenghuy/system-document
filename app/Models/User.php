<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'bio',
        'location',
        'website',
        'photo',
        'timezone',
        'language',
        'notifications_email',
        'notifications_push',
        'notifications_marketing',
        'privacy_profile',
        'privacy_activity',
        'privacy_search',
        'theme',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'notifications_email' => 'boolean',
        'notifications_push' => 'boolean',
        'notifications_marketing' => 'boolean',
        'privacy_profile' => 'boolean',
        'privacy_activity' => 'boolean',
        'privacy_search' => 'boolean',
    ];

    /**
     * Get the evaluations for the user.
     */
    public function evaluations()
    {
        return $this->hasMany(DocumentEvaluation::class);
    }

    /**
     * Get the documents for the user (if user_id exists in documents table).
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get the user's photo URL.
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    /**
     * Get the user's initials for avatar.
     */
    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    /**
     * Get the user's average rating.
     */
    public function getAverageRatingAttribute()
    {
        return $this->evaluations()->avg('rating');
    }

    /**
     * Get the user's total evaluations count.
     */
    public function getTotalEvaluationsAttribute()
    {
        return $this->evaluations()->count();
    }

    /**
     * Get the user's created date with fallback.
     */
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at ? $this->created_at->format('M Y') : 'N/A';
    }
}
