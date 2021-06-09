<!-- ======= Portfolio Section ======= -->
@if(isset($portfolio) && isset($filters) && is_object($portfolio) && is_object($filters))
<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Portfolio</h2>
            <p>Check our Portfolio</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    @foreach($filters as $filter)
                    <li data-filter=".filter-{{ $filter->alias }}">{{ $filter->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

            @foreach($portfolio as $item)
                @if(!empty($item->image))
                <div class="col-lg-4 col-md-6 portfolio-item
                @foreach($item->filters as $itemFilter)
                    {{ 'filter-' . $itemFilter->alias }}
                @endforeach
                ">
                    <div class="portfolio-wrap">
                        <img src="{{ URL::asset('img/portfolio/' . $item->image) }}" class="img-fluid" alt="{{ $item->name}}">
                        <div class="portfolio-info">
                            @if(!empty($item->name))
                            <h4>{{ $item->name }}</h4>
                            @endif
                            @if(!empty($item->filters))
                            <p>
                                @foreach($item->filters as $key=>$itemFilter)
                                {{ $itemFilter->alias }}
                                @if((count($item->filters) - 1) > $key) {{ ', ' }} @endif
                                @endforeach
                            </p>
                            @endif
                            <div class="portfolio-links">
                                <a href="{{ URL::asset('img/portfolio/'  . $item->image) }}" data-gall="portfolioGallery" class="venobox" title="{{ $item->name }}"><i class="bx bx-plus"></i></a>
                                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach

        </div>

    </div>
</section><!-- End Portfolio Section -->
@endif
