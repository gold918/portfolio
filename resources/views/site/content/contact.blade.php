<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Contact</h2>
            <p>Contact Us</p>
        </div>

        @if(!empty($map->link))
        <div>
            <iframe style="border:0; width: 100%; height: 270px;" src="{{ $map->link }}" frameborder="0" allowfullscreen></iframe>
        </div>
        @endif

        <div class="row mt-5">

            @if(isset($contacts) && is_object($contacts))
            <div class="col-lg-4">
                <div class="info">
                    @foreach($contacts as $contact)
                    <div class="contact__item">
                        @if(!empty($contact->icon))
                        <i class="{{ $contact->icon }}"></i>
                        @endif
                        @if(!empty($contact->title))
                        <h4>{{ $contact->title . ':' }}</h4>
                        @endif
                        @if(!empty($contact->value))
                        <p>{{ $contact->value }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="col-lg-8 mt-5 mt-lg-0">

                <form action="{{ route('index') }}" method="post" role="form" class="php-email-form">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validate"></div>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validate"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                        <div class="validate"></div>
                    </div>
                    <div class="mb-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    @csrf
                    <div class="text-center"><button type="submit">Send Message</button></div>
                </form>

            </div>

        </div>

    </div>
</section><!-- End Contact Section -->