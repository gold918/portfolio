<!-- ======= Counts Section ======= -->
@if(isset($counts) && is_object($counts))
<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">

        @foreach($counts as $count)
        <div class="row no-gutters counts__row">
            @if(!empty($count->image))
            <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" data-aos-delay="100" style="background-image: url('img/{{ $count->image }}')"></div>
            @endif
            <div class="col-xl-7 pl-0 pl-lg-5 pr-lg-1 d-flex align-items-stretch" data-aos="fade-left" data-aos-delay="100">
                <div class="content d-flex flex-column justify-content-center">
                    @if(!empty($count->title))
                    <h3>{{ $count->title }}</h3>
                    @endif
                    @if(!empty($count->text))
                    <p>{{ $count->text }}</p>
                    @endif
                    @if(isset($count->countItems) && is_object($count->countItems))
                    <div class="row">
                        @foreach($count->countItems as $item)
                        <div class="col-md-6 d-md-flex align-items-md-stretch">
                            <div class="count-box">
                                @if(!empty($item->icon))
                                <i class="{{ $item->icon }}"></i>
                                @endif
                                @if(!empty($item->number))
                                <span data-toggle="counter-up">{{ $item->number }}</span>
                                @endif
                                @if(!empty($item->main_word) && !empty($item->text))
                                <p><strong>{{ $item->main_word . ' '}}</strong>{{ $item->text }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div><!-- End .content-->
            </div>
        </div>
        @endforeach

    </div>
</section><!-- End Counts Section -->
@endif
