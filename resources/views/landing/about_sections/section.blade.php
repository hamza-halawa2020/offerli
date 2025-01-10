<div class="container relative md:mt-24 mt-16">
    <div class="grid grid-cols-1 pb-8 text-center">
        <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">Key Features</h3>
        <p class="text-slate-400 max-w-xl mx-auto">Create, collaborate, and turn your ideas into incredible
            products with the definitive platform for digital design.</p>
    </div><!--end grid-->


    <!-- Display About Sections -->
    @if ($aboutSections->count() > 0)
        <div class="grid lg:grid-cols-12 md:grid-cols-12 grid-cols-1 mt-8 gap-[30px] items-center">
            <div class="lg:col-span-4 md:col-span-6 lg:order-1 order-2">
                <div class="grid grid-cols-1 gap-[30px]">
                    @foreach ($aboutSections->slice(0, 2) as $aboutSection)
                        <div class="group flex duration-500 xl:p-3">
                            <div
                                class="flex md:order-2 order-1 align-middle justify-center items-center w-14 h-14 mt-1 bg-green-600/5 group-hover:bg-green-600 group-hover:text-white text-green-600 rounded-full text-2xl shadow-sm dark:shadow-gray-800 duration-500">
                                <i data-feather="monitor" class="w-5 h-5"></i>
                            </div>
                            <div class="flex-1 md:order-1 order-2 md:text-end md:me-4 md:ms-0 ms-4">
                                <h4 class="mb-0 text-lg font-medium">{{ $aboutSection->title }}</h4>
                                <p class="text-slate-400 mt-3">{{ $aboutSection->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-4 md:col-span-12 lg:mx-8 lg:order-2 order-1">
                <img src="{{ asset('images/aboutSections/' . ($aboutSection->image ?? 'default.png')) }}"
                    class="mx-auto md:max-w-[300px]" alt="">
            </div>

            <div class="lg:col-span-4 md:col-span-6 order-3">
                <div class="grid grid-cols-1 gap-[30px]">
                    @foreach ($aboutSections->slice(2, 2) as $aboutSection)
                        <div class="group flex duration-500 xl:p-3">
                            <div
                                class="flex align-middle justify-center items-center w-14 h-14 mt-1 bg-green-600/5 group-hover:bg-green-600 group-hover:text-white text-green-600 rounded-full text-2xl shadow-sm dark:shadow-gray-800 duration-500">
                                <i data-feather="user-check" class="w-5 h-5"></i>
                            </div>
                            <div class="flex-1 ms-4">
                                <h4 class="mb-0 text-lg font-medium">{{ $aboutSection->title }}</h4>
                                <p class="text-slate-400 mt-3">{{ $aboutSection->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
