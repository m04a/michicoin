<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta description="{{ $url->meta_description }}">
    <meta keywords="{{ $url->meta_keywords }}">
    <!-- Bootstrap CSS -->
    <link href="theme/bs5/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
      <link rel="stylesheet" href="css/swiper.css" />
      <link rel="stylesheet" href="css/style.css" />
    <base href="{{url('')}}/"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>{{$url->meta_title}} | {{getSetting('general_sitename',TRUE)}}</title>
    @include('michicoin.public.head')
    @yield('css')
  </head>
  <body>

  <div id="root">
      <header class="header header--sticky">
          <div class="container">
              <div class="header__inner">
                  <div class="logo header__logo">
                      <div class="logo__link">
                          <a href="#"><img src="img/logo.png" alt="logo" width="56" height="56" class="logo__img" /></a>
                      </div>
                  </div>
                  <nav class="header__nav">
                      <div class="header__nav-inner">
                          <ul class="menu-list header__menu-list">
                              @foreach(getMenu('principal') as $menuitem)
                                  <li class="menu-list__item">
                                        <a href="{{$menuitem->url()}}" class="menu-list__link">{{$menuitem->name}}</a>
                                  </li>
                              @endforeach
                          </ul>
                          <div class="header__btns">
                              <div class="header__sm-info">
                                  <img src="img/arrow-to-top.svg" alt="icon" class="header__sm-info-icon" id="arrowIconForWidgetHeader" />
                                  <a href="https://coinmarketcap.com/currencies/Michicoin/" target="_blank">
                                      <span id="priceHeader"></span></a>$</div>
                          </div>
                      </div>
                  </nav>
                  <button class="burger-btn header__burger-btn">
            <span class="burger-btn__inner">
              <span class="burger-btn__stick"></span>
            </span>
                  </button>
              </div>
          </div>
      </header>

  </div>
    @yield('content')
    @yield('js')
  <script src="js/swiper.js" defer></script>
  <script src="js/main.js" defer></script>
  <script src="js/scrolltoanchor.js"></script>
  </body>
</html>