<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    protected $fillable = ['list_item', 'status'];

    public function about () {
        return $this->belongsTo(About::class);
    }
}
