<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['user_id', 'name', 'color', 'icon', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
