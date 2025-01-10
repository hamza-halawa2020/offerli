  <footer class="footer bg-dark-footer relative text-gray-200 dark:text-gray-200" id="contactUs">
      <div class="container relative">
          <div class="grid grid-cols-12">
              <div class="col-span-12">
                  <div class="py-[60px] px-0">
                      <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                          <div class="lg:col-span-4 md:col-span-12">
                              <a class="logo" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                                  <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                  <h3>{{ trans('landing.Offerli') }}</h3>
                              </a>

                              <ul class="list-none mt-6">

                                  <li class="inline"><a href="http://linkedin.com/company/shreethemes" target="_blank"
                                          class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-800 rounded-md hover:border-lime-600 dark:hover:border-lime-600 hover:bg-green-600 dark:hover:bg-green-600"><i
                                              class="uil uil-linkedin" title="Linkedin"></i></a></li>
                                  <li class="inline"><a href="https://www.facebook.com/shreethemes" target="_blank"
                                          class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-800 rounded-md hover:border-lime-600 dark:hover:border-lime-600 hover:bg-green-600 dark:hover:bg-green-600"><i
                                              class="uil uil-facebook-f align-middle" title="facebook"></i></a></li>
                                  <li class="inline"><a href="https://www.instagram.com/shreethemes/" target="_blank"
                                          class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-800 rounded-md hover:border-lime-600 dark:hover:border-lime-600 hover:bg-green-600 dark:hover:bg-green-600"><i
                                              class="uil uil-instagram align-middle" title="instagram"></i></a></li>
                                  <li class="inline"><a href="https://twitter.com/shreethemes" target="_blank"
                                          class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-800 rounded-md hover:border-lime-600 dark:hover:border-lime-600 hover:bg-green-600 dark:hover:bg-green-600"><i
                                              class="uil uil-twitter align-middle" title="twitter"></i></a></li>
                                  <li class="inline"><a href="mailto:support@shreethemes.in"
                                          class="h-8 w-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center border border-gray-800 rounded-md hover:border-lime-600 dark:hover:border-lime-600 hover:bg-green-600 dark:hover:bg-green-600"><i
                                              class="uil uil-envelope align-middle" title="email"></i></a></li>
                                  <a class="" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                                      <img src="{{ asset('assets/landing/tax.svg') }}" alt="tax" width=150> 
                                  </a>

                              </ul><!--end icon-->
                          </div><!--end col-->

                          <div class="lg:col-span-2 md:col-span-4">
                              <h5 class="tracking-[1px] text-gray-100 font-semibold">Company</h5>
                              <ul class="list-none footer-list mt-6">

                                  <li class="mt-[10px]"><a href="{{ route('faq') }}"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i> FAQ</a></li>

                                  <li class="mt-[10px]"><a href="portfolio-creative-four.html"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i> SLA Policy</a></li>
                                  <li class="mt-[10px]"><a href="blog.html"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i data-i18n="Blog"> Blog</a></li>

                              </ul>
                          </div><!--end col-->

                          <div class="lg:col-span-3 md:col-span-4">
                              <h5 class="tracking-[1px] text-gray-100 font-semibold">Usefull Links</h5>
                              <ul class="list-none footer-list mt-6">
                                  <li><a href="{{ route('terms_of_service') }}"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i> Terms of Services</a></li>
                                  <li class="mt-[10px]"><a href="{{ route('privacy_policy') }}"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i> Privacy Policy</a></li>
                                  <li class="mt-[10px]"><a href="page-pricing.html"
                                          class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i
                                              class="uil uil-angle-right-b"></i> Payment And Refund</a></li>

                              </ul>
                          </div><!--end col-->

                          <div class="lg:col-span-3 md:col-span-4">
                              <h5 class="tracking-[1px] text-gray-100 font-semibold">Newsletter</h5>
                              <p class="mt-6">Sign up and receive the latest tips via email.</p>
                              <form>
                                  <div class="grid grid-cols-1">
                                      <div class="my-3">
                                          <label class="form-label">Write your email <span
                                                  class="text-red-600">*</span></label>
                                          <div class="form-icon relative mt-2">
                                              <i data-feather="mail" class="w-4 h-4 absolute top-3 start-4"></i>
                                              <input type="email"
                                                  class="form-input ps-12 rounded w-full py-2 px-3 h-10 bg-gray-800 border-0 text-gray-100 focus:shadow-none focus:ring-0 placeholder:text-gray-200"
                                                  placeholder="Email" name="email" required="">
                                          </div>
                                      </div>

                                      <button type="submit" id="submitsubscribe" name="send"
                                          class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-green-700 border-lime-600 hover:border-green-700 text-white rounded-md">Subscribe</button>
                                  </div>
                              </form>
                          </div><!--end col-->

                      </div><!--end grid-->
                  </div><!--end col-->
              </div>
          </div><!--end grid-->
      </div><!--end container-->

      <div class="py-[30px] px-0 border-t border-slate-800">
          <div class="container relative text-center">
              <div class="grid md:grid-cols-2 items-center">
                  <div class="md:text-start text-center">
                      <p class="mb-0">©
                          <script>
                              document.write(new Date().getFullYear())
                          </script> Offerli
                      </p>
                  </div>


              </div><!--end grid-->
          </div><!--end container-->
      </div>
  </footer><!--end footer-->
