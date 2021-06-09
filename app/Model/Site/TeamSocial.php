<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class TeamSocial extends Model
{
    protected $fillable = ['name', 'icon', 'link', 'status'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
