<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';
    protected $fillable = ['name', 'alias', 'image', 'text', 'status'];

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'filters_portfolio')->where('status', 1)
                                                                                    ->where('created_at', '<=', Carbon::now())
                                                                                   ->where('updated_at', '<=', Carbon::now());
    }

    public function filtersAll()
    {
        return $this->belongsToMany(Filter::class, 'filters_portfolio');
    }
}
