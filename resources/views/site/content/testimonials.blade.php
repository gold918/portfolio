<!-- ======= Testimonials Section ======= -->
@if(isset($testimonials) && is_object($testimonials))
<section id="testimonials" class="testimonials"
         @if(!empty($testimonials->background_image)) style="background-image: url('img/{{ $testimonials->background_image }}')" @endif
>
    <div class="container" data-aos="zoom-in">

        @if(isset($testimonials->testimonialItems) && is_object($testimonials->testimonialItems))
        <div class="owl-carousel testimonials-carousel">

            @foreach($testimonials->testimonialItems as $item)
            <div class="testimonial-item">
                @if(!empty($item->photo))
                <img src="{{ URL::asset('img/testimonials/' . $item->photo) }}" class="testimonial-img" alt="{{ $item->name }}">
                @endif
                @if(!empty($item->name))
                <h3>{{ $item->name }}</h3>
                @endif
                @if(!empty($item->position))
                <h4>{{ $item->position }}</h4>
                @endif
                @if(!empty($item->review))
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    {{ $item->review }}
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                @endif
            </div>
            @endforeach

        </div>
        @endif
    </div>
</section><!-- End Testimonials Section -->
@endif
