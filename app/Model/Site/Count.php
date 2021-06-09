<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
    protected $fillable = ['title', 'text', 'image', 'status'];

    public function countItems()
    {
        return $this->hasMany(CountItem::class)->where('status', 1)
                                                      ->where('created_at', '<=', Carbon::now())
                                                      ->where('updated_at', '<=', Carbon::now())
                                                      ->take(4);
    }

    public function countItemsAll()
    {
        return $this->hasMany(CountItem::class);
    }
}
