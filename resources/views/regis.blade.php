<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1" name="viewport">

    <meta content="./assets/images/common/og-image.jpg" property="og:image">
    <link href="assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css" rel="stylesheet">
    <link href="assets/css/theme.min.css" rel="stylesheet">
    <link href="assets/css/utility.min.css" rel="stylesheet">
    <link href="assets/css/demo/start-hub-2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="css2?family=Be+Vietnam+Pro:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">
    <title>Codingo</title>
</head>

<body data-disable-animations-onmobile="true" data-mobile-header-builder="true" data-mobile-header-scheme="gray"
    data-mobile-logo-alignment="default" data-mobile-nav-breakpoint="1199" data-mobile-nav-scheme="dark"
    data-mobile-nav-style="modern" data-mobile-nav-trigger-alignment="right" data-overlay-onmobile="true">

    <form action="/regis" method="POST">
        @csrf
        <div class="lity-modal lqd-modal lity-hide" data-modal-type="fullscreen" id="contact-modal">
            <div class="lqd-modal-inner">
                <div class="lqd-modal-head"></div>
                <div class="lqd-modal-content link-black">
                    <div class="container">
                        <div class="row min-h-100vh items-center">
                            <div class="w-55percent p-10 sm:w-full">
                                <div class="flex flex-col w-full pr-90 lg:pr-0">
                                    <div class="ld-fancy-heading relative">
                                        <h2
                                            class="ld-fh-element mb-0/5em inline-block relative text-120 font-medium leading-0/8em text-blue-600">
                                            Daftar Sekarang</h2>
                                    </div>
                                    <div class="ld-fancy-heading relative">
                                        <p class="ld-fh-element mb-0/5em inline-block relative text-18">Dan Dapatkan
                                            Pengalaman Belajar Yang Menyenangkan.</p>
                                    </div>
                                    <div class="w-full flex flex-wrap">
                                        <div class="w-50percent flex flex-col p-10 sm:w-full">
                                            <div class="mb-10 ld-fancy-heading relative">
                                                <h6
                                                    class="ld-fh-element mb-0/5em inline-block relative text-black text-14 font-bold tracking-0">
                                                    careers</h6>
                                            </div>
                                            <div class="mb-10 ld-fancy-heading relative">
                                                <p
                                                    class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/25em">
                                                    Would you like to join our growing team?</p>
                                            </div>
                                            <div class="ld-fancy-heading relative">
                                                <p class="ld-fh-element mb-0/5em inline-block relative"><a
                                                        class="text-16 font-bold leading-1/2em" href="#"><span
                                                            class="__cf_email__"
                                                            data-cfemail="9efdffecfbfbeceddef6ebfcb0fdf1f3">[email&#160;protected]</span></a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="w-50percent flex flex-col p-10 sm:w-full">
                                            <div class="mb-10 ld-fancy-heading relative">
                                                <h6
                                                    class="ld-fh-element mb-0/5em inline-block relative text-black text-14 font-bold tracking-0">
                                                    careers</h6>
                                            </div>
                                            <div class="mb-10 ld-fancy-heading relative">
                                                <p
                                                    class="ld-fh-element mb-0/5em inline-block relative text-16 leading-1/25em">
                                                    Would you like to join our growing team?</p>
                                            </div>
                                            <div class="ld-fancy-heading relative">
                                                <p class="ld-fh-element mb-0/5em inline-block relative"><a
                                                        class="text-16 font-bold leading-1/2em" href="#"><span
                                                            class="__cf_email__"
                                                            data-cfemail="f695978493938485b69e8394d895999b">[email&#160;protected]</span></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-45percent sm:w-full">
                                <div
                                    class="lqd-contact-form lqd-contact-form-inputs-underlined lqd-contact-form-button-block lqd-contact-form-button-lg lqd-contact-form-button-border-none">
                                    <div lang="en-US" role="form">
                                        <div class="screen-reader-response">
                                            <p aria-atomic="true" aria-live="polite" role="status"></p>
                                        </div>
                                        <form action="./assets/php/mailer.php" class="lqd-cf-form"
                                            data-status="init" method="post" novalidate="novalidate">
                                            <div class="row">
                                                <div class="col col-xs-12 col-sm-6 relative py-0"><i
                                                        class="lqd-icn-ess icon-lqd-user"></i> <span
                                                        class="lqd-form-control-wrap"><input aria-invalid="false"
                                                            aria-required="true"
                                                            class="text-13 text-black border-black-20"
                                                            name="name" placeholder="Siapa nama mu?"
                                                            size="40" type="text" value=""></span>
                                                </div>
                                                <div class="col col-xs-12 col-sm-6 relative py-0"><i
                                                        class="lqd-icn-ess icon-lqd-envelope"></i> <span
                                                        class="lqd-form-control-wrap"><input aria-invalid="false"
                                                            aria-required="true"
                                                            class="text-13 text-black border-black-20"
                                                            name="email" placeholder="Alamat Email"
                                                            size="40" type="email" value=""></span>
                                                </div>
                                                <div class="col col-xs-12 col-sm-6 relative py-0"><i
                                                        class="lqd-icn-ess icon-speech-bubble"></i> <span
                                                        class="lqd-form-control-wrap"><input aria-invalid="false"
                                                            aria-required="true"
                                                            class="text-13 text-black border-black-20"
                                                            name="username" placeholder="Username mu"
                                                            size="40" type="text" value="" required></span>
                                                </div>
                                                <div class="col col-xs-12 col-sm-6 relative py-0"><i
                                                        class="lqd-icn-ess icon-lqd-dollar"></i> <span
                                                        class="lqd-form-control-wrap"><input aria-invalid="false"
                                                            aria-required="true"
                                                            class="text-13 text-black border-black-20"
                                                            name="password" placeholder="password" size="40"
                                                            type="password" value=""></span></div>
                                                <div class="col col-12 lqd-form-textarea relative py-0"><i
                                                        class="lqd-icn-ess icon-lqd-pen-2"></i> <span
                                                        class="lqd-form-control-wrap">
                                                        <textarea aria-invalid="false" aria-required="true" class="text-13 text-black border-black-20" cols="10"
                                                            name="message" placeholder="Deskripsi singkat tentang proyek/permintaan/konsultasi Anda" rows="6"></textarea>
                                                    </span>
                                                </div>
                                                <div class="col col-xs-12 text-center relative py-0"><button
                                                        class="bg-primary text-white text-17 font-medium leading-1/5em hover:bg-primary hover:text-white rounded-100"
                                                        type="submit" id="submitButton">— daftar —</button>


                                                    <script>
                                                        document.getElementById('submitButton').addEventListener('click', function(event) {
                                                            event.preventDefault(); // Prevent default action (following the href)
                                                            document.querySelector('form').submit(); // Submit the form
                                                        });
                                                    </script>


                                                    <p class="mt-1em text-black"><span>— copy email:</span> <a
                                                            href="#"><span class="__cf_email__"
                                                                data-cfemail="4920272f26092520383c202d643d212c242c3a672a2624">[email&#160;protected]</span></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="lqd-cf-response-output"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lqd-modal-foot"></div>
            </div>
        </div>
    </form>
    {{-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/vendors/jquery.min.js"></script>
    <script src="assets/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendors/fastdom/fastdom.min.js"></script>
    <script src="assets/vendors/fresco/js/fresco.js"></script>
    <script src="assets/vendors/lity/lity.min.js"></script>
    <script src="assets/vendors/gsap/minified/gsap.min.js"></script>
    <script src="assets/vendors/gsap/utils/CustomEase.min.js"></script>
    <script src="assets/vendors/gsap/minified/DrawSVGPlugin.min.js"></script>
    <script src="assets/vendors/gsap/minified/ScrollTrigger.min.js"></script>
    <script src="assets/vendors/draw-shape/liquidDrawShape.min.js"></script>
    <script src="assets/vendors/animated-blob/liquidAnimatedBlob.min.js"></script>
    <script src="assets/vendors/fontfaceobserver.js"></script>
    <script src="assets/vendors/tinycolor-min.js"></script>
    <script src="assets/vendors/gsap/utils/SplitText.min.js"></script>
    <script src="assets/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/vendors/isotope/packery-mode.pkgd.min.js"></script>
    <script src="assets/vendors/flickity/flickity.pkgd.min.js"></script>
    <script src="assets/vendors/draggabilly.pkgd.min.js"></script>
    <script src="assets/vendors/particles.min.js"></script>
    <script src="assets/js/liquid-gdpr.min.js"></script>
    <script src="assets/js/theme.min.js"></script>
    <script src="assets/js/liquid-ajax-contact-form.min.js"></script> --}}

</body>

</html>
