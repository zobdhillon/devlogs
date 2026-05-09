<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['user_id', 'name', 'color', 'icon', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
