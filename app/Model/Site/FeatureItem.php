<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class FeatureItem extends Model
{
    protected $fillable = ['title', 'text', 'icon', 'status'];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
