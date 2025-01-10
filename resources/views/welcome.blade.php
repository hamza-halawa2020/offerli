<!-- Start Navbar -->
@include('landing.navbar_sections.index')
<!-- End Navbar -->

<!-- Start section -->
<section>

    @include('landing.header_sections.index')

    @include('landing.feature_sections.index')

    @include('landing.about_sections.index')

    @include('landing.partner_sections.index')

    @include('landing.mobile_apps.index')

</section>
<!--end section-->
<div class="relative">
    <div class="shape absolute sm:-bottom-px -bottom-[2px] start-0 end-0 overflow-hidden z-1 text-dark-footer">
        <svg class="w-full h-auto scale-[2.0] origin-top" viewBox="0 0 2880 250" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
        </svg>
    </div>
</div>

<!-- Footer Start -->
@include('landing.footer_sections.index')
<!-- Footer End -->

<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top"
    class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 h-9 w-9 text-center bg-green-600 text-white leading-9"><i
        class="uil uil-arrow-up"></i></a>
<!-- Back to top -->

<!-- Switcher -->
@include('landing.switcher.index')
<!-- Switcher -->


<!-- JAVASCRIPTS -->
<script src={{ asset('assets/landing/js/app.js') }}></script>
<script src={{ asset('assets/landing/libs/tiny-slider/min/tiny-slider.js') }}></script>
<script src={{ asset('assets/landing/libs/feather-icons/feather.min.js') }}></script>
<script src={{ asset('assets/landing/js/plugins.init.js') }}></script>


<script>
    function toggleMenu() {
        document.getElementById('isToggle').classList.toggle('open');
        var isOpen = document.getElementById('navigation')
        if (isOpen.style.display === "block") {
            isOpen.style.display = "none";
        } else {
            isOpen.style.display = "block";
        }
    };
</script>
<!-- JAVASCRIPTS -->
</body>

</html>
