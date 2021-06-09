<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['image', 'status'];

    public function featureItems()
    {
        return $this->hasMany(FeatureItem::class)->where('status', 1)
                                                        ->where('created_at', '<=', Carbon::now())
                                                        ->where('updated_at', '<=', Carbon::now());
    }

    public function featureItemsAll()
    {
        return $this->hasMany(FeatureItem::class);
    }
}
