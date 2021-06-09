<!-- ======= Features Section ======= -->
@if(isset($features) && is_object($features))
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">
            @foreach($features as $feature)
                <div class="row features__row">
                    @if(!empty($feature->image))
                    <div class="image col-lg-6" style='background-image: url({{ URL::asset('img/' . $feature->image) }});' data-aos="fade-right"></div>
                    @endif
                    @if(isset($feature->featureItems) && is_object($feature->featureItems))
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                        @foreach($feature->featureItems->take(4) as $key => $item)
                        <div class="icon-box mt-5 @if($key == 0) {{ 'mt-lg-0' }} @endif" data-aos="zoom-in" data-aos-delay="150">
                            @if(!empty($item->icon))
                            <i class="bx {{ $item->icon }}"></i>
                            @endif
                            @if(!empty($item->title))
                            <h4>{{ $item->title }}</h4>
                            @endif
                            @if(!empty($item->text))
                            <p>{{ $item->text }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section><!-- End Features Section -->
@endif
