@extends('themes.default.public.layouts.base')
@section('content')



        <main class="main">
            <div class="main-screen">
                <div class="container">
                    <div class="main-screen__inner">
                       {{-- <img src="img/logo.png" alt="img" width="513" height="685" class="main-screen__main-img" />--}}
                    </div>
                </div>
            </div>
            <div>
                <div class="big-info">
                    <h1 class="heading big-made-text">{{__('public.community')}}</h1>
                    <div class="container">
                        <div class="big-info-inner">
                            <div class="big-info__text-box">
                                <div class="heading">
                                    <div>{{$page->getContent('main_title') ?? ''}}</div>
                                </div>
                                <div class="links-list big-info__links-list">
                                    @foreach(getSetting('contact_networks',FALSE) as $network)
                                        <a target="_blank" href="{{$network->link ?? ''}}" class="links-list__link">
                                            <img src="{{$network->image ?? ''}}" alt="img" width="40" height="40" class="links-list__icon">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="join-the-community" id="com">
                    <div class="container">
                        <div class="join-the-community__inner grid-12">
                            <div class="heading--decorator heading join-the-community__heading"> {{__('public.last_news')}}</div>
                            <div class="join-the-community__items grid-12">
                                <div class="grid-12 join-the-community__item join-the-community__item--twiter">
                                    <div class="join-the-community__header">
                                        <span class="join-the-community__header-name">Michicoin</span>
                                        <span class="join-the-community__header-name-socmedia">Twitter</span>
                                        <span class="join-the-community__header-cheked"><img src="img/checked.png" alt=""
                                                                                             class="join-the-community__header-checked-img" /></span>
                                    </div>
                                    <div class="join-the-community__nick-name">@MichicoinMars</div>
                                    <div class="join-the-community__title">I am Michicoin. Michicoin. Join me and together we will reach
                                        the stars...</div>
                                    <div class="join-the-community__follow">
                                        <span class="follow__amount">650K+</span>
                                        <span class="follow__followers">followers</span>
                                        <div class="follow__bttn">
                                            <a target="_blank" href="https://twitter.com/Michicoinmars" class="bttn__follow">Follow</a>
                                        </div>
                                    </div>
                                    <div class="join-the-community__socmedia-img-wrap">
                                        <img src="img/tw.png"
                                             class="join-the-community__socmedia-img join-the-community__socmedia-img--twiter" alt="" />
                                    </div>
                                </div>
                                <div class="grid-12 join-the-community__item join-the-community__item--telegram">
                                    <div class="join-the-community__header">
                                        <span class="join-the-community__header-name">Michicoin</span>
                                        <span class="join-the-community__header-name-socmedia">Telegram</span>
                                        <span class="join-the-community__header-cheked"><img src="img/checked.png" alt=""
                                                                                             class="join-the-community__header-checked-img" /></span>
                                    </div>
                                    <div class="join-the-community__nick-name">https://t.me/MichicoinMars</div>
                                    <div class="join-the-community__title">I am Michicoin. Michicoin. Join me and together we will reach
                                        the stars...</div>
                                    <div class="join-the-community__follow">
                                        <span class="follow__amount">90K+</span>
                                        <span class="follow__followers">followers</span>
                                        <div class="follow__bttn">
                                            <a target="_blank" href="https://t.me/Michicoinmars" class="bttn__follow">Follow</a>
                                        </div>
                                    </div>
                                    <div class="join-the-community__socmedia-img-wrap">
                                        <img src="img/tg.png"
                                             class="join-the-community__socmedia-img join-the-community__socmedia-img--telegram" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comics" id="saga">
                <div id="comic" class="container">
                    <div class="comics__inner">
                        <div class="comics__heading-box">
                            <div class="heading comics__heading">{{__('public.comic_title')}}</div>
                        </div>
                        <div class="comics__swiper swiper mySwiper">
                            <div class="comics__swiper-wrapper swiper-wrapper">
                                <div class="comics__swiper-slide swiper-slide">
                                    <div class="comics__img">
                                        <a href="https://opensea.io/assets/0xea9707d71ed5c3bd0af871711cb3b597ef1ab043/2" target="_blank">
                                            <img src="img/comics/01.jpg" alt="img" width="448" height="580">
                                        </a>
                                    </div>
                                    <div class="comics__text-box">
                                        <p class="comics__text comics__text--big">Michicoin #01</p>
                                        <p class="comics__text">Year 2420: Mars has been successfully re-colonized after the first
                                            galactic
                                            voyage. A young Rufus and Astrid Mars settle in for their morning pancakes as they discuss plans
                                            for the future, but little do they know of the storm that is brewing beyond the walls of their
                                            cozy colony...</p>
                                    </div>
                                </div>
                                <div class="comics__swiper-slide swiper-slide">
                                    <div class="comics__img">
                                        <a href ="https://opensea.io/assets/0xea9707d71ed5c3bd0af871711cb3b597ef1ab043/10003" target="_blank">
                                            <img src="img/comics/02.jpg" alt="img" width="448" height="580">
                                        </a>
                                    </div>
                                    <div class="comics__text-box">
                                        <p class="comics__text comics__text--big">Michicoin #02</p>
                                        <p class="comics__text">The sound of grinding metal, roaring flame and relentless gunfire signals
                                            the arrival of one of the galaxy's most fearful foes: the Annihilators. The innocence of young
                                            Michicoin and the life of comfort he has known on Mars hangs by a thread, the outcome of which
                                            depends entirely on a prototype device that could change the universe forever...</p>
                                    </div>
                                </div>
                                <div class="comics__swiper-slide swiper-slide">
                                    <div class="comics__img">
                                        <a href="https://opensea.io/assets/0xea9707d71ed5c3bd0af871711cb3b597ef1ab043/10004" target="_blank">
                                            <img src="img/comics/03.jpg" alt="img" width="448" height="580" class="comics__img">
                                        </a>
                                    </div>
                                    <div class="comics__text-box">
                                        <p class="comics__text comics__text--big">Michicoin #03</p>
                                        <p class="comics__text">In a flash of emerald light baby Michicoin plummets from an alien sky toward
                                            the jungles of somewhere strange and distant. Fearsome predators are drawn toward the bizarre
                                            occurence, but so too are unexpected friends.</p>
                                    </div>
                                </div>
                                <div class="comics__swiper-slide swiper-slide">
                                    <div class="comics__img">
                                        <a href="https://opensea.io/assets/0xea9707d71ed5c3bd0af871711cb3b597ef1ab043/10005" target="_blank">
                                            <img src="img/comics/04.jpg" alt="img" width="448" height="580" class="comics__img">
                                        </a>
                                    </div>
                                    <div class="comics__text-box">
                                        <p class="comics__text comics__text--big">Michicoin #04</p>
                                        <p class="comics__text">Contact is made to rendezvous with a mysterious yet familiar figure, but
                                            before baby Michicoin and his strange new friend can reach their destination, another transmission
                                            signals grave danger. The chase is on!</p>
                                    </div>
                                </div>
                            </div>
                            <nav class="comics__nav">
                                <button class="comics__btn-prev"></button>
                                <div class="swiper-pagination comics__swiper-pagination"></div>
                                <button class="comics__btn-next"></button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer__inner">
                    <div class="footer__top">
                        <div class="logo footer__logo">
                            <div class="logo__link">
                                <img src="img/logo.png" alt="logo" width="56" height="56" class="logo__img" />
                            </div>
                        </div>
                        <nav class="footer__nav">
                            <ul class="menu-list footer__menu-list">
                                <li class="menu-list__item">
                                    <a href="#com" class="menu-list__link">Community</a>
                                </li>
                                <li class="menu-list__item">
                                    <a href="#saga" class="menu-list__link">Comics</a>
                                </li>
                                <li class="menu-list__item">
                                    <a href="#start" class="menu-list__link">Get Started</a>
                                </li>
                            </ul>
                            <div class="links-list links-list--small footer__links-list">
                                @foreach(getSetting('contact_networks',FALSE) as $network)
                                    <a target="_blank" href="{{$network->link ?? ''}}" class="links-list__link">
                                        <img src="{{$network->image ?? ''}}" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                @endforeach
                            </div>
                        </nav>
                    </div>
                    <div class="footer__bottom">
                    </div>
                </div>
            </div>
        </footer>

    <script src="js/swiper.js" defer></script>
    <script src="js/main.js" defer></script>
    <script src="js/scrolltoanchor.js"></script>

@stop