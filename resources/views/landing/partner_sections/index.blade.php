@if ($partnerSection->count() > 0)

    <div class="container relative md:mt-24 mt-16">


        <div class="grid grid-cols-1 pb-8 text-center">
            <h6 class="text-green-600 text-base mb-2">Partners</h6>
            <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">
                What Our Partners Say
            </h3>

            <p class="text-slate-400 max-w-xl mx-auto">Search all the open positions on the web. Get your own
                personalized salary estimate. Read reviews on over 30000+ companies worldwide.</p>
        </div>

        <div class="grid grid-cols-1 mt-8">
            <div class="tiny-three-item">
                @foreach ($partnerSection as $partner)
                    <div class="tiny-slide text-center">
                        <div class="cursor-e-resize">

                            <div class="text-center mt-5">
                                <img src="{{ asset('images/partnerSections/' . $partner->image) }}"
                                    class="h-14 w-14 rounded-full shadow-md mx-auto" alt="">
                                <h6 class="mt-2 font-semibold">{{ $partner->title }}</h6>
                                <span class="text-slate-400 text-sm">{{ $partner->description }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif
