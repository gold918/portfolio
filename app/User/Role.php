<?php

namespace App\User;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users() {
        return $this->hasMany(User::class);
    }

    public function rules() {
        return $this->belongsToMany(Rule::class);
    }
}
