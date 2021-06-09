<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class CountItem extends Model
{
    protected $fillable = ['main_word', 'text', 'icon', 'number', 'status'];

    public function count () {
        return $this->belongsTo(Count::class);
    }
}
