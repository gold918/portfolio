<?php

namespace App\Model\Site;

use Illuminate\Database\Eloquent\Model;

class TestimonialItem extends Model
{
    protected $fillable = ['name', 'photo', 'position', 'review', 'status'];

    public function testimonial()
    {
       return $this->belongsTo(Testimonial::class);
    }
}
