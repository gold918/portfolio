<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
