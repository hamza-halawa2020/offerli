<div class="container relative md:mt-24 mt-16">
    <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-[30px]">
        <div class="relative order-1 md:order-2">
            <img src="{{ asset('images/aboutSections/' . ($aboutSection->image ?? 'default.png')) }}" class="mx-auto"
                alt="">

            <div
                class="overflow-hidden absolute lg:h-[400px] h-[320px] lg:w-[400px] w-[320px] bg-green-600/5 bottom-2/4 translate-y-2/4 end-0 rotate-45 -z-1 shadow-md shadow-green-600/10 rounded-[100px]">
            </div>
        </div>

        <div class="lg:me-8 order-2 md:order-1">
            <h4 class="mb-4 md:text-3xl text-2xl lg:leading-normal leading-normal font-medium">
                {{ $aboutSection->title ?? 'no title' }}

            </h4>
            <p class="text-slate-400">
                {{ $aboutSection->description ?? 'no description' }}

            </p>

        </div>
    </div>
</div>


@include('landing.about_sections.section')
