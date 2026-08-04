<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar'
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
        'password' => 'hashed',
    ];


    public function dermatologist()
    {
        return $this->hasOne(Dermatologist::class);
    }

    /**
     * A usable avatar URL for this user, whatever their role.
     *
     * Falls back through: the photo on their role profile (dermatologist or
     * patient — a user only ever holds one of the two), then the avatar copied
     * from a social login, then the template's default image. Views must not
     * branch on role for this — doing so is what left superadmin and patient
     * accounts with an empty avatar box in the admin panel.
     */
    public function getAvatarUrlAttribute(): string
    {
        $profileImage = $this->dermatologist?->profile_image
            ?? $this->patient?->profile_image;

        if ($profileImage && Storage::disk('public')->exists($profileImage)) {
            return asset('storage/' . $profileImage);
        }

        if ($this->avatar) {
            // Social logins (GoogleController) store an absolute URL; anything
            // else is treated as a path on the public disk.
            if (Str::startsWith($this->avatar, ['http://', 'https://'])) {
                return $this->avatar;
            }

            if (Storage::disk('public')->exists($this->avatar)) {
                return asset('storage/' . $this->avatar);
            }
        }

        return asset('assets/img/avatars/1.png');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
