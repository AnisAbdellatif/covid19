<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = ['user_id', 'title', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
