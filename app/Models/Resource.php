<?php

namespace App\Models;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'title', 'url', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
