<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Codinggo" name="keywords">
    <meta content="LiquidThemes" name="author">
    <meta content="Codinggo" name="description">
    <meta content="Codinggo" property="og:title">
    <meta content="Codinggo" property="og:description">
    <meta content="website" property="og:type">
    <meta content="{{ asset('./assets/images/common/og-image.jpg') }}" property="og:image">
    <link href="{{ asset('assets/vendors/liquid-icon/lqd-essentials/lqd-essentials.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/utility.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/demo/start-hub-2.css') }}" rel="stylesheet">

    <title>Detail Kursus</title>
    <link rel="stylesheet" href="{{ asset('assets/css/detailcor.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />



    <link rel="icon" href="{{ asset('assets/images/demo/start-hub-2/logo/sidelogo.png') }}">
</head>

<body>

    <header class="main-header main-header-overlay" data-sticky-header="true" data-sticky-values-measured="false"
        id="site-header">
        <div class="border-bottom text-white-10 pl-30 pr-10 module-header"
            style="background: linear-gradient(120deg, #c9bffb 0%, #182ed8 150%);">
            <div class="container-fluiud flex items-center justify-between">
                <div class="w-25percent flex items-center justify-start xl:w-15percent lg:w-40percent">
                    <div class="flex navbar-brand-plain py-20 sm:hidden"><a class="navbar-brand flex p-0 relative"
                            href="/" rel="home"><span class="navbar-brand-inner post-rel"><img
                                    alt="StartInaama" class="logo-sticky"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo-d-1.svg') }}"> <img
                                    alt="StartInaama" class="logo-default"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo.png') }}"></span></a>
                    </div>
                    <div class="navbar-brand-plain py-20 xxl:hidden xl:hidden sm:flex"><a
                            class="navbar-brand flex p-0 relative" href="/" rel="home"><span
                                class="navbar-brand-inner post-rel"><img alt="StartInaama" class="logo-sticky"
                                    src="assets/images/demo/start-hub-2/logo/logo-mob-d.svg">
                                <img alt="StartInaama" class="logo-default"
                                    src="{{ asset('assets/images/demo/start-hub-2/logo/logo.png') }}"></span></a>
                    </div>
                </div>
                <div class="w-50percent flex items-center justify-center header-desktop xl:w-55percent lg:hidden">
                    <div class="module-primary-nav flex link-14">
                        <div aria-expanded="false"
                            class="link-font-medium navbar-collapse inline-flex p-0 lqd-submenu-default-style"
                            role="navigation">
                            {{-- <ul class="main-nav flex reset-ul inline-ul lqd-menu-counter-right lqd-menu-items-inline main-nav-hover-fill lqd-submenu-toggle-hover link-white"
                            data-localscroll="true"
                            data-localscroll-options="{&quot;itemsSelector&quot;:&quot;> li > a&quot;, &quot;trackWindowScroll&quot;: true, &quot;includeParentAsOffset&quot;: true}"
                            data-submenu-options="{&quot;toggleType&quot;: &quot;fade&quot;, &quot;handler&quot;: &quot;mouse-in-out&quot;}">
                            <li class="menu-item-home is-active"><a href="#banner"><span>Home</span> </a></li>
                            <li><a href="#about"><span>Why Us?</span> </a></li>
                            <li class="menu-item-has-children position-applied"><a
                                    href="#services"><span>Our Courses</span> <span class="submenu-expander"><svg
                                            height="32" style="width: 1em; height: 1em;" viewbox="0 0 21 32"
                                            width="21" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.5 18.375l7.938-7.938c.562-.562 1.562-.562 2.125 0s.562 1.563 0 2.126l-9 9c-.563.562-1.5.625-2.063.062L.437 12.562C.126 12.25 0 11.876 0 11.5s.125-.75.438-1.063c.562-.562 1.562-.562 2.124 0z"
                                                fill="currentColor"></path>
                                        </svg> </span> </a></li>
                            <li><a href="#clients"><span>Customer Stories</span> </a></li>
                            <li><a href="#contact"><span>Contact Us</span> </a></li>
                        </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="w-25percent flex items-center justify-end mr-20 lg:w-60percent lg:mr-0">
                    <div class="flex items-center justify-end">
                        <div class="module-social lg:hidden">
                            {{-- <div class="social-icons-wrapper justify-end"><span class="grid-item"><a
                                    class="icon social-icon animation-pulse-grow items-center text-15 text-white-30"
                                    href="#" target="_blank"><span class="sr-only">Facebook</span> <svg
                                        class="text-15" fill="currentColor" height="1em"
                                        viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z">
                                        </path>
                                    </svg> </a></span><span class="grid-item"><a
                                    class="icon social-icon animation-pulse-grow items-center text-15 text-white-30"
                                    href="#" target="_blank"><span class="sr-only">Twitter</span> <svg
                                        class="text-15" fill="currentColor" height="1em"
                                        viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                        </path>
                                    </svg> </a></span><span class="grid-item"><a
                                    class="icon social-icon animation-pulse-grow items-center text-15 text-white-30"
                                    href="#" target="_blank"><span class="sr-only">Github</span> <svg
                                        class="text-15" fill="currentColor" height="1em"
                                        viewbox="0 0 496 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                        </path>
                                    </svg></a></span>
                        </div> --}}
                        </div>
                        <a class="btn-hover" href="/logreg"
                            style="display: inline-block; padding: 0.375em 0.75em; border: none; cursor: pointer; text-align: center; text-decoration: none; transition: all 0.3s ease; background-color: #FF7F3F; color: white; border-radius: 100px; margin-left: 10px; font-size: 15px; font-weight: 500; width: 200px;">
                            <span class="btn-txt" data-text="Login">Masuk/Daftar</span>
                        </a>

                        {{-- <span class="btn-txt" data-text="Login">Masuk/Daftar</span>
                        </a> --}}

                        <div class="ml-15 ld-module-sd ld-module-sd-hover ld-module-sd-right xxl:hidden lg:block">
                            <button aria-expanded="false"
                                class="bg-transparent border-none nav-trigger flex relative items-center justify-center style-6 collapsed"
                                data-bs-target="#lqd-drawer-mobile" data-bs-toggle="collapse" data-ld-toggle="true"
                                data-toggle-options="{&quot;cloneTriggerInTarget&quot;: false, &quot;type&quot;: &quot;click&quot;}"
                                role="button" type="button">
                                {{-- <span class="bars inline-block relative z-1"><span
                                    class="bars-inner flex flex-col w-full h-full"><span
                                        class="bar inline-block relative"></span> <span
                                        class="bar inline-block relative"></span> <span
                                        class="bar inline-block relative"></span></span></span> --}}
                            </button>
                            {{-- <div class="ld-module-dropdown collapse absolute" id="lqd-drawer-mobile">
                            <div class="ld-sd-wrap">
                                <div class="p-40 ld-sd-inner justify-center flex-col">
                                    <div class="module-primary-nav flex">
                                        <div aria-expanded="false"
                                            class="w-full navbar-collapse inline-flex p-0 lqd-submenu-default-style"
                                            id="main-header-collapse" role="navigation">
                                            <ul class="main-nav flex reset-ul lqd-menu-counter-right lqd-menu-items-block main-nav-hover-default"
                                                data-localscroll="true"
                                                data-localscroll-options="{&quot;itemsSelector&quot;:&quot;> li > a&quot;, &quot;trackWindowScroll&quot;: true, &quot;includeParentAsOffset&quot;: true}"
                                                data-submenu-options="{&quot;toggleType&quot;: &quot;slide&quot;, &quot;handler&quot;: &quot;click&quot;}"
                                                id="primary-nav">
                                                <li class="menu-item-home is-active"><a
                                                        class="w-full text-20 text-black font-medium leading-1/5em"
                                                        href="#banner"><span>Home</span> <span
                                                            class="link-icon inline-flex hide-if-empty right-icon"><i
                                                                class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span></a>
                                                </li>
                                                <li><a class="w-full text-20 text-black font-medium leading-1/5em"
                                                        href="#about"><span>About</span> <span
                                                            class="link-icon inline-flex hide-if-empty right-icon"><i
                                                                class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span></a>
                                                </li>
                                                <li class="menu-item-has-children"><a
                                                        class="w-full text-20 text-black font-medium leading-1/5em"
                                                        href="#services"><span>Our Courses</span> <span
                                                            class="submenu-expander absolute inline-flex right-0"></span></a>
                                                </li>
                                                <li><a class="w-full text-20 text-black font-medium leading-1/5em"
                                                        href="#clients"><span>Customer Stories</span> <span
                                                            class="link-icon inline-flex hide-if-empty right-icon"><i
                                                                class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span></a>
                                                </li>
                                                <li><a class="w-full text-20 text-black font-medium leading-1/5em"
                                                        href="#contact"><span>Contact Us</span> <span
                                                            class="link-icon inline-flex hide-if-empty right-icon"><i
                                                                class="lqd-icn-ess icon-ion-ios-arrow-down"></i></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="flex justify-start mt-25 gap-25"><a
                                            class="icon social-icon social-icon-facebook animation-pulse-grow text-26 w-25"
                                            href="#" target="_blank"><span
                                                class="sr-only">Facebook</span>
                                            <svg class="w-1em h-1em relative block" fill="#0000003D"
                                                viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z">
                                                </path>
                                            </svg>
                                        </a><a
                                            class="icon social-icon social-icon-twitter animation-pulse text-26 w-25-grow"
                                            href="#" target="_blank"><span
                                                class="sr-only">Twitter</span>
                                            <svg class="w-1em h-1em relative block" fill="#0000003D"
                                                viewbox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                                </path>
                                            </svg>
                                        </a><a
                                            class="icon social-icon social-icon-github animation-pulse-grow text-26 w-25"
                                            href="#" target="_blank"><span
                                                class="sr-only">Github</span>
                                            <svg class="w-1em h-1em relative block" fill="#0000003D"
                                                viewbox="0 0 496 512" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                                </path>
                                            </svg>
                                        </a></div>
                                </div>
                            </div>
                        </div> --}}
                            <div class="lqd-module-backdrop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>





    <p class="jud"> <a href="/">Home</a> > <span>Deskripsi</span></p>
    <section class="container py-5 mt-100" id="skills">
        <img src="{{ asset('uploaded_files/' . $course->thumb) }}" alt=""
            >
        <article>
            <h1>{{ $course->title }}</h1>
            <p class="pol">{{ $course->description }}</p>
            <hr>
            <h2>Rp{{ number_format($course->harga, 0, ',', '.') }}</h2>
            <hr>
            <h2>Sesi</h2>
            <ul>
                @foreach ($contents as $content)
                    <li>{{ $content->title }}</li>
                @endforeach
            </ul>
            <hr>
            <div class="tutor">
                <img src="{{ asset('uploaded_files/' . $tutor->image) }}" alt=""
                    style="width: 100px; height: 100px; object-fit: scale-down; border-radius: 50%;">
                <div class="block">
                    <h4>{{ $tutor->name }}</h4>
                    <h5>{{ $tutor->profession }}</h5>
                </div>
            </div>
            <hr>
            <div class="beli">
                <a href="{{ route('tutor.trans', $course->id) }}">Beli</a>
            </div>

        </article>
    </section>


    <footer class="main-footer" id="site-footer">
        <section class="lqd-section footer-content pt-270 pb-100 relative bg-transparent transition-all"
            style="background-image: linear-gradient(180deg, #E5DFFC 0%, #fff 100%);">
            <div class="lqd-shape lqd-shape-top" data-negative="false">
                <svg class="lqd-custom-shape -rotate-180 h-220" fill="none" height="461"
                    preserveaspectratio="none" viewbox="0 0 1440 461" width="1440"
                    xmlns="http://www.w3.org/2000/svg">
                    <path class="lqd-shape-fill"
                        d="m0 131.906 34.4-20.017c34.4-19.9 103.2-59.936 171.68-82.979 68.64-23.043 136.8-29.328003 205.44-4.306 68.48 25.022 137.28 81.35 205.76 80.768 68.64-.582 136.8-58.074 205.44-84.608 68.48-26.535 137.28-22.345 205.76-16.06 68.64 6.168 136.8 14.315 205.44 22.811 68.48 8.612 137.28 17.457 171.68 22l34.4 4.422v396.851h-1440z"
                        fill="#fff" fill-opacity=".09">
                        <animate attributename="d" dur="10s" fill="freeze" repeatcount="indefinite"
                            values="M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z; M0 122.906L36.5 109C71.5 96.372 102.52 67.98 171 44.937C239.64 21.894 354.36 51.478 423 76.5C491.48 101.522 546.52 19.097 615 18.515C683.64 17.933 799.36 58.534 868 32C936.48 5.46499 1039.52 54.715 1108 61C1176.64 67.168 1190.36 -6.996 1259 1.5C1327.48 10.112 1371.2 35.972 1405.6 40.515L1440 44.937V441.788H0L0 122.906Z; M0 131.906L34.4 111.889C68.8 91.989 137.6 51.953 206.08 28.91C274.72 5.867 342.88 -0.418001 411.52 24.604C480 49.626 548.8 105.954 617.28 105.372C685.92 104.79 754.08 47.298 822.72 20.764C891.2 -5.771 960 -1.581 1028.48 4.704C1097.12 10.872 1165.28 19.019 1233.92 27.515C1302.4 36.127 1371.2 44.972 1405.6 49.515L1440 53.937V450.788H0L0 131.906Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M0 154.75L34.4 142.201C68.8 129.53 137.6 104.433 206.08 99.072C274.72 93.833 342.88 108.453 411.52 122.099C480 135.622 548.8 148.293 617.28 142.811C685.92 137.329 754.08 113.693 822.72 113.693C891.2 113.693 960 137.329 1028.48 152.68C1097.12 168.153 1165.28 175.463 1233.92 184.966C1302.4 194.591 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z"
                        fill="#fff" fill-opacity=".28">
                        <animate attributename="d" dur="8s" fill="freeze" repeatcount="indefinite"
                            values="M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 33.4 177.201 55 176.5C76.6 175.799 137.52 110.361 206 105C274.64 99.761 332.86 141.104 401.5 154.75C469.98 168.273 527.52 206.982 596 201.5C664.64 196.018 747.86 75 816.5 75C884.98 75 956.52 118.149 1025 133.5C1093.64 148.973 1163.36 87.497 1232 97C1300.48 106.625 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z; M0 154.75C0 154.75 12.8 142.902 34.4 142.201C56 141.5 140.02 160.111 208.5 154.75C277.14 149.511 334.36 112.57 403 126.216C471.48 139.739 552.52 190.448 621 184.966C689.64 179.484 745.36 116 814 116C882.48 116 950.52 161.149 1019 176.5C1087.64 191.973 1154.36 123.997 1223 133.5C1291.48 143.125 1371.2 206.287 1405.6 212.257L1440 218.105V452.025H0L0 154.75Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M0 340.22L34.4 333.92C68.8 327.52 137.6 314.92 206.08 312.22C274.72 309.52 342.88 316.92 411.52 319.72C480 322.52 548.8 320.92 617.28 318.92C685.92 316.92 754.08 314.52 822.72 316.02C891.2 317.52 960 322.92 1028.48 309.42C1097.12 295.92 1165.28 263.52 1233.92 251.02C1302.4 238.52 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z"
                        fill="#fff">
                        <animate attributename="d" dur="6.5s" fill="freeze" repeatcount="indefinite"
                            values="M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z; M0 340.22L37.5 323C71.9 316.6 137.52 336.62 206 333.92C274.64 331.22 339.86 272.2 408.5 275C476.98 277.8 551.02 304 619.5 302C688.14 300 759.36 266.5 828 268C896.48 269.5 962.02 336.5 1030.5 323C1099.14 309.5 1156.36 232.5 1225 220C1293.48 207.5 1364.1 249.62 1398.5 253.22L1440 253.22V453.22H0L0 340.22Z; M0 340.22L34.4 333.92C68.8 327.52 139.02 281.2 207.5 278.5C276.14 275.8 351.86 331.12 420.5 333.92C488.98 336.72 554.52 289 623 287C691.64 285 756.86 332.42 825.5 333.92C893.98 335.42 960 322.92 1028.48 309.42C1097.12 295.92 1163.36 236 1232 223.5C1300.48 211 1371.2 245.92 1405.6 249.52L1440 253.22V453.22H0L0 340.22Z">
                        </animate>
                    </path>
                    <path class="lqd-shape-fill"
                        d="M1440 337.719L1405.6 340.219C1371.2 342.719 1302.4 347.719 1233.92 350.419C1165.28 353.019 1097.12 353.419 1028.48 352.219C960 351.019 891.2 348.419 822.72 357.019C754.08 365.719 685.92 385.719 617.28 395.919C548.8 406.019 480 406.419 411.52 395.919C342.88 385.419 274.72 364.019 206.08 359.419C137.6 354.719 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z"
                        fill="#fff">
                        <animate attributename="d" dur="5.5s" fill="freeze" repeatcount="indefinite"
                            values="M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1295.98 326.3 1227.5 329C1158.86 331.6 1081.64 391.2 1013 390C944.52 388.8 874.48 364.119 806 372.719C737.36 381.419 675.14 296.3 606.5 306.5C538.02 316.6 471.48 383.219 403 372.719C334.36 362.219 272.64 320.6 204 316C135.52 311.3 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z; M1440 337.719L1405.6 340.219C1371.2 342.719 1303.98 362.8 1235.5 365.5C1166.86 368.1 1090.14 324.2 1021.5 323C953.02 321.8 889.48 383.4 821 392C752.36 400.7 678.64 368.519 610 378.719C541.52 388.819 473.48 414.5 405 404C336.36 393.5 273.64 342.319 205 337.719C136.52 333.019 68.8 366.719 34.4 372.719L0 378.719V460.719H1440V337.719Z">
                        </animate>
                    </path>
                </svg>
            </div>
            <div class="container">
                <div class="row items-center">
                    {{-- <div class="col col-12 col-md-3 flex items-center justify-start"><img alt="logo Inaama"
                            height="21" src="assets/images/demo/start-hub-2/logo/logo1.png" width="145">
                    </div> --}}
                    {{-- <div class="col col-12 col-md-9">
                        <div class="flex flex-wrap alogn-items-center justify-end">
                            <div class="w-auto lg:w-full lg:justify-start module-btn"><a
                                    class="btn btn-solid text-9 font-bold uppercase tracking-1 py-5 px-15 mr-25 text-secondary rounded-4 bg-blue-50 hover:text-white hover:bg-secondary"
                                    data-lity="#contact-modal" href="#contact-modal"><span class="btn-txt"
                                        data-text="Apply">Apply</span></a></div>
                            <div
                                class="flex justify-end text-end lqd-fancy-menu lqd-custom-menu relative text-end lqd-menu-td-none link-bold link-10 link-black-80 lg:w-full sm:text-start module-menu">
                                <ul class="reset-ul inline-ul uppercase">
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Management</a></li>
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Reporting</a></li>
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Tracking</a></li>
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Subscribe</a></li>
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Company</a></li>
                                    <li class="tracking-1 mr-35"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Careers</a></li>
                                    <li class="tracking-1 mr-0"><a class="uppercase tracking-1/5"
                                            href="#"><span
                                                class="link-icon inline-flex hide-if-empty left-icon icon-next-to-label"></span>
                                            Press</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 mt-5 p-15"><span
                            class="divider w-full flex border-top border-lightgray"></span></div>
                    <div class="col col-12 col-md-8">
                        <div class="ld-fancy-heading relative">
                            <p class="ld-fh-element mb-0/5em inline-block relative text-12 leading-1/75em">These
                                Terms
                                will be applied fully and affect to your use of this Website. By using this Website,
                                you
                                agreed to accept all terms and conditions written in here. You must not use this
                                Website if
                                you disagree with any of these Website Standard Terms and Conditions.</p>
                        </div>
                    </div> --}}
                    {{-- <div class="col col-12 col-md-4">
                        <div class="flex flex-row justify-end items-center gap-10 sm:justify-start"><a
                                class="icon social-icon animation-grow mr-25 text-24 w-25 h-25 leading-24"
                                href="#" target="_blank"><span class="sr-only">Instagram</span>
                                <svg class="w-1em h-1em relative block" viewbox="0 0 448 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                                        fill="#5F7A9E"></path>
                                </svg>
                            </a><a class="icon social-icon animation-grow text-24 w-25 h-25 leading-24" href="#"
                                target="_blank">
                                <svg class="w-1em h-1em relative block" viewbox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
                                        fill="#5F7A9E"></path>
                                </svg>
                            </a></div>
                    </div> --}}
                </div>
            </div>
        </section>
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
