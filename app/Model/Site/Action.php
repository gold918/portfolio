<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = [
        'title',
        'text',
        'button_text',
        'link',
        'background_image',
        'status',
    ];
}
