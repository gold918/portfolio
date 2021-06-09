<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class HeroIconBox extends Model
{
    protected $fillable = ['title', 'alias', 'icon', 'status'];

    public function heroMain () {
        return $this->belongsTo('App\Model\Site\HeroMain');
    }
}
