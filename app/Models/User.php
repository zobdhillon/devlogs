<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'bio',
        'email',
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
