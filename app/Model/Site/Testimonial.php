<?php

namespace App\Model\Site;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['background_image', 'status'];

    public function testimonialItems()
    {
        return $this->hasMany(TestimonialItem::class)->where('status', 1)
                                                            ->where('created_at', '<=', Carbon::now())
                                                            ->where('updated_at', '<=', Carbon::now());;
    }

    public function testimonialItemsAll()
    {
        return $this->hasMany(TestimonialItem::class);
    }
}
