<!-- ======= Team Section ======= -->
@if(isset($teamMembers) && is_object($teamMembers))
<section id="team" class="team">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Team</h2>
            <p>Check our Team</p>
        </div>

        <div class="row">

            @foreach($teamMembers as $teamMember)
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        @if(!empty($teamMember->photo))
                        <img src="{{ URL::asset('img/team/' . $teamMember->photo) }}" class="img-fluid"
                         alt="@if(isset($teamMember->name)) {{ $teamMember->name }} @endif"
                        >
                        @endif
                        @if(isset($teamMember->teamSocials) && is_object($teamMember->teamSocials))
                        <div class="social">
                            @foreach($teamMember->teamSocials as $social)
                                @if(!empty($social->link) && !empty($social->icon))
                                <a href="{{ $social->link }}"><i class="{{ $social->icon }}"></i></a>
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @if(!empty($teamMember->name) && !empty($teamMember->position))
                    <div class="member-info">
                        <h4>{{ $teamMember->name }}</h4>
                        <span>{{ $teamMember->position }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

        </div>

    </div>
</section><!-- End Team Section -->
@endif
