<!-- ======= Clients Section ======= -->
@if(isset($clients) && is_object($clients))
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">

            <div class="owl-carousel clients-carousel">
                @foreach($clients as $client)
                    @if(!empty($client->logo))
                        <img src="{{ URL::asset('img/clients/' . $client->logo) }}" alt="{{ $client->name }}">
                    @endif
                @endforeach
            </div>

        </div>
    </section><!-- End Clients Section -->
@endif
