<!-- ======= Cta Section ======= -->
@if(isset($action) && is_object($action))
<section id="cta" class="cta"
    @if(!empty($action->background_image)) style="background: linear-gradient(rgba(2, 2, 2, 0.5),
                                                                rgba(0, 0, 0, 0.5)),
                                                                url('img/{{ $action->background_image }}')
                                                                fixed center center;" @endif
 >
    <div class="container" data-aos="zoom-in">

        <div class="text-center">
            @if(!empty($action->title))
            <h3>{{ $action->title }}</h3>
            @endif
            @if(!empty($action->text))
            <p>{{ $action->text }}</p>
            @endif
            @if(!empty($action->button_text) && !empty($action->link))
            <a class="cta-btn" href="#">{{ $action->button_text }}</a>
            @endif
        </div>

    </div>
</section><!-- End Cta Section -->
@endif
