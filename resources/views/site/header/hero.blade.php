<!-- ======= Hero Section ======= -->
@if(isset($heroes) && is_object($heroes))
    @foreach($heroes as $hero)
        <section id="{{ $hero->alias }}" class="d-flex align-items-center justify-content-center hero" style="background-image: url('img/{{ $hero->background_image }}')")>
            <div class="container" data-aos="fade-up">

                <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-xl-6 col-lg-8">
                        <h1>{{ $hero->title }}</h1>
                        <h2>{{ $hero->text }}</h2>
                    </div>
                </div>

                @if(isset($hero->heroIconBoxes) && is_object($hero->heroIconBoxes))
                    <div class="row mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">

                        @foreach($hero->heroIconBoxes as $key => $icon)
                            <div class="col-xl-2 col-md-4 col-6
                                @if($key == 2) {{ 'mt-4 mt-md-0' }} @endif
                                @if($key > 2 && $key < 6) {{ 'mt-4 mt-xl-0' }} @endif
                                @if($key > 5) {{ 'mt-4' }} @endif
                            ">
                                <div class="icon-box">
                                    <i class="{{ $icon->icon }}"></i>
                                    <h3><a href="">{{ $icon->title }}</a></h3>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>
        </section><!-- End Hero -->
    @endforeach

@endif
