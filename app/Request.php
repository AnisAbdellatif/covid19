<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['user_id', 'wanted', 'description', 'link', 'finished'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
