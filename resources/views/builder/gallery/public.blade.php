

<div id="carousel{{$wid}}" class="carousel slide" data-bs-ride="carousel">
        @if(isset($fbcc->options->navigation) && $fbcc->options->navigation && count((array)$fbcc->items)  > 1)
        @if($bsversion==5)
        <div class="carousel-indicators">
            @foreach($fbcc->items as $pos=>$galitem)
            <button type="button" data-bs-target="#carousel{{$wid}}" data-bs-slide-to="{{$pos}}" class="{{$pos==0?'active':''}}" aria-label="{{$galitem->title ?? ''}}"></button>
            @endforeach
        </div>
          @else
                <ol class="carousel-indicators carousel-indicators-circle">
                @foreach($fbcc->items as $pos=>$galitem)
                <li data-target="#carousel{{$wid}}" data-slide-to="{{$pos}}" class=" {{$pos==0?'active':''}}"></li>
                @endforeach
                </ol>
        @endif
        @endif

  <div class="carousel-inner">
  @foreach($fbcc->items as $pos=>$galitem)
  <?php 
    $alignClass = $galitem->align ?? '';
  ?>
    <div class="carousel-item {{$pos==0?'active':''}} " >
      <div class="banner banner-lg " style="background-image:url({{getImage($galitem->image,1900)}})">
        <div class="container">
            <div class=" col-8 col-md-6 col-lg-4 py-5 ">
                  <div>
                      <div class="banner-title" >{{$galitem->title}}</div>
                      <div class="banner-subtitle" >{{$galitem->subtitle}}</div>
                      @if($galitem->btn!='' && $galitem->link!='')
                      <a href="{{$galitem->link}}" class="btn btn-lg btn-xl btn-white">{{$galitem->btn}}</a>
                      @endif
                  </div>
            </div>
          </div>
      </div>
    </div>
    @endforeach
  </div>
  @if(isset($fbcc->options->controls) && $fbcc->options->controls && count((array)$fbcc->items)  > 1)
  @if($bsversion==5)
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$wid}}" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$wid}}" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
    @else

<a class="carousel-control-prev" href="#carousel{{$wid}}" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel{{$wid}}" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
@endif
  @endif
</div>