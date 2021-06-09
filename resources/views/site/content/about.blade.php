<!-- ======= About Section ======= -->
@if(isset($about) && is_object($about))
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            @foreach($about as $aboutItem)
                <div class="row about__row">
                    @if(!empty($aboutItem->image))
                        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                            <img src="{{ URL::asset('img/' . $aboutItem->image) }}" class="img-fluid" alt="">
                        </div>
                    @endif
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
                        @if(!empty($aboutItem->title))
                            <h3>{{ $aboutItem->title }}</h3>
                        @endif

                        @if(!empty($aboutItem->subtitle))
                            <p class="font-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                        @endif

                         @if(!empty($aboutItem->aboutItems && is_object($aboutItem->aboutItems)))
                            <ul>
                                @foreach($aboutItem->aboutItems as $item)
                                @if(!empty($item->list_item))
                                    <li><i class="ri-check-double-line"></i> {{ $item->list_item }}</li>
                                @endif
                                @endforeach
                            </ul>
                        @endif
                        @if(!empty($aboutItem->text))
                            <p>{{ $aboutItem->text }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section><!-- End About Section -->
@endif
