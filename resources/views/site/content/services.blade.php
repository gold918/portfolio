<!-- ======= Services Section ======= -->
@if(isset($services) && is_object($services))
<section id="services" class="services">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Services</h2>
            <p>Check our Services</p>
        </div>

        <div class="row">
            @foreach($services as $key => $service)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch
                @if($key > 0) {{ 'mt-4' }} @endif
                @if($key == 1) {{ 'mt-md-0' }} @endif
                @if($key == 2) {{ 'mt-lg-0' }} @endif
            " data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                    @if(!empty($service->icon))
                    <div class="icon"><i class="bx {{ $service->icon }}"></i></div>
                    @endif
                    @if(!empty($service->title))
                    <h4><a href="">{{ $service->title }}</a></h4>
                    @endif
                    @if(!empty($service->text))
                    <p>{{ $service->text }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Services Section -->
@endif
