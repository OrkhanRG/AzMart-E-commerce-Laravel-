<footer class="site-footer border-top">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 col-lg-6 mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Menyu</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('front.index') }}">Anasəhifə</a></li>
                            <li><a href="{{ route('about') }}">Haqqımızda</a></li>
                            <li><a href="{{ route('product') }}">Məhsullar</a></li>
                            <li><a href="{{ route('contact') }}">Əlaqə</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Əlaqə Məlumatları</h3>
                    <ul class="list-unstyled">
                        <li class="address">{{ $settings['address'] ??  'Default Address'}}</li>
                        <li class="phone"><a href="tel://{{str_replace($settings['phone'], '-', '')}}">{{ $settings['phone'] ??  'Default Phone'}}</a></li>
                        <li class="email">{{ $settings['email'] ?? 'Default Email' }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> {{ date('Y')  }} Bütün müəllif hüquqları qorunur | Developer: <i class="icon-heart" aria-hidden="true"></i> by <a href="javascript:void(0)" target="_blank" class="text-primary">OrkhaN</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>

        </div>
    </div>
</footer>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
@yield('js')
<script src="{{ asset('js/main.js') }}"></script>


</body>
</html>
