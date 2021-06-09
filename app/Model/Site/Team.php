<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'position', 'photo', 'status'];

    public function teamSocials()
    {
        return $this->hasMany(TeamSocial::class)->where('status', 1)
                                                       ->where('created_at', '<=', Carbon::now())
                                                       ->where('updated_at', '<=', Carbon::now());
    }

    public function teamSocialsAll()
    {
        return $this->hasMany(TeamSocial::class);
    }
}
