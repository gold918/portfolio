<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HeroMain extends Model
{
    protected $table = 'hero_main';
    protected $fillable = ['title', 'text', 'background_image', 'status'];

    public function heroIconBoxes ()
    {
        return $this->hasMany(HeroIconBox::class)->where('status', 1)
                                                        ->where('created_at', '<=', Carbon::now())
                                                        ->where('updated_at', '<=', Carbon::now());
    }
    public function heroIconBoxesAll ()
    {
        return $this->hasMany(HeroIconBox::class);
    }
}
