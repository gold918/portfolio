<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'alias', 'text', 'icon', 'status'];
}
