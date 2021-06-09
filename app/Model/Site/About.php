<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $fillable = ['title', 'subtitle', 'text', 'image', 'status'];

    public function aboutItems()
    {
        return $this->hasMany(AboutItem::class)->where('status', 1)
                                                      ->where('created_at', '<=', Carbon::now())
                                                      ->where('updated_at', '<=', Carbon::now());
    }

    public function aboutItemsAll()
    {
        return $this->hasMany(AboutItem::class);
    }
}
