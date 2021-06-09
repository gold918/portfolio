<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $fillable = ['name', 'alias', 'status'];

    public function portfolio()
    {
        return $this->belongsToMany(Portfolio::class, 'filters_portfolio')->where('status', 1)
                                                                                      ->where('created_at', '<=', Carbon::now())
                                                                                      ->where('updated_at', '<=', Carbon::now());
    }

    public function portfolioAll()
    {
        return $this->belongsToMany(Portfolio::class, 'filters_portfolio');
    }
}
