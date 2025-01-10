<section
    class="relative table w-full py-36 md:py-56 md:pb-0 overflow-hidden bg-[url('../../assets/landing/images/app/bg.png')] bg-top bg-no-repeat bg-fixed bg-cover">
    <div class="absolute inset-0 bg-black opacity-80"></div>
    <div class="container relative z-2">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
            <div class="lg:col-span-8 md:col-span-7 md:mb-16">
                <div class="md:me-6">
                    <h4 class="font-bold text-white lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5">
                        {{ $headerSection->title ?? 'no title' }}
                    </h4>
                    <p class="text-white/70 text-lg max-w-xl">
                        {{ $headerSection->description ?? 'not description' }}
                    </p>

                    <div class="mt-6">
                        <a href=""><img src={{ asset('assets/landing/images/app/app.png') }}
                                class="inline-block m-1" alt=""></a>
                        <a href=""><img src={{ asset('assets/landing/images/app/playstore.png') }}
                                class="inline-block m-1" alt=""></a>
                    </div>
                </div>
            </div><!--end col-->

            <div class="lg:col-span-4 md:col-span-5 md:mt-0">
                <div
                    class="relative after:content-[''] after:absolute after:h-40 after:w-40 after:bg-indigo-600 after:bottom-0 after:end-0  after:-z-0 after:rounded-3xl after:animate-[spin_10s_linear_infinite]">
                    <img src="{{ asset('images/HeaderSections/' . ($headerSection->image ?? 'default.png')) }}"
                        class="relative z-1" alt="">
                </div>
            </div><!--end col-->
        </div><!--end grid-->
    </div><!--end container-->

</section><!--end section-->

<div class="relative">
    <div
        class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden z-1 text-white dark:text-slate-900">
        <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 250" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
