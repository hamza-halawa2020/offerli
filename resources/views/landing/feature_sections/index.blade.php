<section class="relative md:py-24 py-16 overflow-hidden" id="aboutus">
    <div class="container relative">
        @include('landing.feature_sections.what_we_do')

        @if ($featureSection->count() > 0)
            <div class="grid md:grid-cols-3 grid-cols-1 mt-8 gap-[30px]">
                @foreach ($featureSection as $feature)
                    <div
                        class="group p-6 md:px-4 rounded-lg shadow dark:shadow-gray-800 hover:shadow-md dark:hover:shadow-gray-700 bg-white dark:bg-slate-900 text-center duration-500">
                        <div
                            class="w-16 h-16 bg-green-600/5 text-green-600 rounded-lg text-2xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800 mx-auto">
                            <img src="{{ asset('images/featureSections/' . $feature->image) }}"
                                alt="{{ $feature->title }}" class="rounded-lg" width="50px" height="50px">
                        </div>

                        <div class="content mt-7">
                            <a href="#"
                                class="title h5 text-lg font-medium hover:text-green-600">{{ $feature->title }}</a>
                            <p class="text-slate-400 mt-3">{{ $feature->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div><!--end container-->
