@extends('themes.default.public.layouts.base')
@section('content')



        <main class="main">
            <div class="main-screen">
                <div class="container">
                    <div class="main-screen__inner">
                        <img src="img/main-screen/title-img.png" alt="img" width="750" height="183"
                             class="main-screen__title-img" />
                       {{-- <img src="img/logo.png" alt="img" width="513" height="685" class="main-screen__main-img" />--}}
                    </div>
                </div>
            </div>
            <div>
                <div class="big-info">
                    <div class="container">
                        <div class="big-info__inner">
                            <div class="big-info__text-box">
                                <div class="heading big-info__heading text-red-500">I am Michicoin. Michicoin. Join me and together we will reach
                                    the
                                    stars.</div>
                                <div class="links-list big-info__links-list">
                                    <a target="_blank" href="https://t.me/Michicoinmars" class="links-list__link">
                                        <img src="img/list-links/tg.svg" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                    <a target="_blank" href="https://twitter.com/Michicoinmars" class="links-list__link">
                                        <img src="img/list-links/tw.svg" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                    <a target="_blank" href="https://coinmarketcap.com/currencies/Michicoin/" class="links-list__link">
                                        <img src="img/list-links/03.svg" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                    <a target="_blank" href="https://www.coingecko.com/en/coins/Michicoin-mars" class="links-list__link">
                                        <img src="img/list-links/coingecko.png" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                    <a target="_blank" href="https://app.uniswap.org/#/swap?inputCurrency=eth&outputCurrency=0x761d38e5ddf6ccf6cf7c55759d5210750b5d60f3" class="links-list__link">
                                        <img src="img/list-links/uniswap.svg" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                    <a target="_blank" href="https://etherscan.io/token/0x761d38e5ddf6ccf6cf7c55759d5210750b5d60f3" class="links-list__link">
                                        <img src="img/list-links/traced.svg" alt="img" width="40" height="40" class="links-list__icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="join-the-community" id="com">
                    <div class="container">
                        <div class="join-the-community__inner grid-12">
                            <div class="heading--decorator heading join-the-community__heading">Join the Community!</div>
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
                            <div class="get-stiker-pack grid-12">
                                <div class="get-stiker-pack__title">
                                    <span class="heading">Get the Michicoin sticker pack!</span>
                                    <img src="img/small-logo-telegram.svg" alt="" class="get-stiker-pack__small-icon-tg" />
                                </div>
                                <div class="get-stiker-pack__bttn-wrap">
                                    <a target="_blank" href="https://t.me/addstickers/MichicoinMarsStickers" class="get-stiker-pack__bttn">Download</a>
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
                            <div class="heading comics__heading">A Cosmic Saga begins...</div>
                        </div>
                        <div class="comics__swiper swiper mySwiper">
                            <div class="comics__info-box">
                                <div class="comics__logo logo">
                                    <img src="img/logo.png" alt="img" width="56" height="56" class="logo__img">
                                </div>
                                <p class="comics__info-text">
                                    Follow the story of Michicoin as he explores the greatest mysteries of the galaxy and seeks to
                                    recolonize the planet he once called home with the help of the friends he’s made during his travels
                                    through the stars.
                                </p>
                            </div>
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
            <div class="statistics" id="token">
                <div class="container">
                    <script src="https://files.coinmarketcap.com/static/widget/currency.js"></script><div class="coinmarketcap-currency-widget" data-currencyid="9436" data-base="USD" data-secondary="" data-ticker="true" data-rank="true" data-marketcap="true" data-volume="true" data-statsticker="false" data-stats="USD"></div>
                    <div class="statistics-inner grid-12">
                        <div class="statistics-inner__top-level grid-12">
                            <div class="statistics-inner-top-level__logo">
                                <img src="img/big-logo.png" alt="" class="statistics-inner-top-level__logo-img" />
                            </div>
                            <div class="statistics-inner-top-level__info">
                                <div class="statistics-inner-top-level__coin-name">
                                    <span class="statistics-inner-top-level__title"> Michicoin</span>
                                    <div class="statistics-inner-top-level__short-name">ELON</div>
                                </div>
                                <div class="statistics-inner-top-level__some-info">
                                    <span class="statistics-inner-top-level__price"><span id="price">0.000000</span> $</span>
                                    <span class="statistics-inner-top-level__arrow-to-top">
                    <img src="img/arrow-to-top.svg" alt="icon" class="statistics-inner-top-level__arrow-to-top-img" id="arrowIconForWidget" />
                  </span>
                                    <span class="statistics-inner-top-level__procent" id="percent">---</span>
                                </div>
                            </div>
                            <a target="_blank" href="https://coinmarketcap.com/currencies/Michicoin/" class="statistics-inner-top-level__power-by">Powered by CoinMarketCap</a>
                        </div>
                        <div class="statistics-inner__bottom-level">
                            <div class="statistics-inner-bottom-level__item">
                                <div class="statistics-inner-bottom-level-item__heading">Rank</div>
                                <div class="statistics-inner-bottom-level-item__number" id="rank">---</div>
                            </div>
                            <div class="statistics-inner-bottom-level__item statistics-inner-bottom-level__item--border">
                                <div class="statistics-inner-bottom-level-item__heading">Market Cap</div>
                                <div class="statistics-inner-bottom-level-item__number" id="marketCap">---</div>
                            </div>
                            <div class="statistics-inner-bottom-level__item">
                                <div class="statistics-inner-bottom-level-item__heading">Volume</div>
                                <div class="statistics-inner-bottom-level-item__number" id="volume">---</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="guide" id="start">
                <div class="container">
                    <div class="guide__inner grid-12">
                        <div class="heading heading--decorator guide__heading">Quick Start Guide</div>

                        <div class="guide__items grid-12">
                            <div class="guide__item guide__item--one">
                                <div class="guide-item__number">01</div>
                                <div class="guide-item__img-wrap">
                                    <img src="img/guide1.png" alt="" class="guide-item__img guide-item__img--one" />
                                </div>
                                <div class="guide-item__heading">Create MetaMask wallet</div>
                                <div class="guide-item__text">Create a MetaMask Wallet using either a desktop computer or an
                                    iOS/Android
                                    mobile device. That will allow you to buy, sell, send, and receive ELON</div>
                            </div>

                            <div class="guide__item guide__item--two">
                                <div class="guide-item__number">02</div>
                                <div class="guide-item__img-wrap">
                                    <img src="img/guide2.png" alt="" class="guide-item__img guide-item__img--two" />
                                </div>
                                <div class="guide-item__heading">Send ETH to your wallet</div>
                                <div class="guide-item__text">You can buy Ethereum (ETH) directly on MetaMask or transfer it to your
                                    MetaMask Wallet from exchanges like Coinbase, Binance, etc.</div>
                            </div>

                            <div class="guide__item guide__item--three">
                                <div class="guide-item__number">03</div>
                                <div class="guide-item__img-wrap">
                                    <img src="img/guide3.png" alt="" class="guide-item__img guide-item__img--three" />
                                </div>
                                <div class="guide-item__heading">Connect your wallet</div>
                                <div class="guide-item__text">Access your wallet by clicking ‘Connect to a wallet’ and selecting
                                    MetaMask.</div>
                            </div>

                            <div class="guide__item guide__item--four">
                                <div class="guide-item__number">04</div>
                                <div class="guide-item__img-wrap">
                                    <img src="img/guide4.png" alt="" class="guide-item__img guide-item__img--four" />
                                </div>
                                <div class="guide-item__heading">Swap ETH for ELON</div>
                                <div class="guide-item__text">You can start swapping as soon as you have ETH available! Press ‘Select
                                    a
                                    token’ and enter the token address or search for it on the tokens list.</div>
                            </div>
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
                                <a target="_blank" href="https://t.me/Michicoinmars" class="links-list__link">
                                    <img src="img/list-links/tg.svg" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
                                <a target="_blank" href="https://twitter.com/Michicoinmars" class="links-list__link">
                                    <img src="img/list-links/tw.svg" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
                                <a target="_blank" href="https://coinmarketcap.com/currencies/Michicoin/" class="links-list__link">
                                    <img src="img/list-links/03.svg" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
                                <a target="_blank" href="https://www.coingecko.com/en/coins/Michicoin-mars" class="links-list__link">
                                    <img src="img/list-links/coingecko.png" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
                                <a target="_blank" href="https://app.uniswap.org/#/swap?inputCurrency=eth&outputCurrency=0x761d38e5ddf6ccf6cf7c55759d5210750b5d60f3" class="links-list__link">
                                    <img src="img/list-links/uniswap.svg" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
                                <a target="_blank" href="https://etherscan.io/token/0x761d38e5ddf6ccf6cf7c55759d5210750b5d60f3" class="links-list__link">
                                    <img src="img/list-links/traced.svg" alt="img" width="40" height="40" class="links-list__icon">
                                </a>
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