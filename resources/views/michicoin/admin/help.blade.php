@extends(backpack_view('blank'))


@section('content')

@foreach($cats as $cat)
<h3 class=" ">{{$cat->title}}</h3>

<div class="row">
    @foreach($cat->helps as $h)
    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-header">
            <b class="card-title mb-0">{{$h->title}}</b>
            </div>
               
                <div class="card-body">
                  

                   <div class="mb-4 embed-responsive embed-responsive-16by9">
                    <video width="320" height="240" controls>
                        <source src=" {{asset('storage/'.$h->video)}}" type="video/mp4">
                        Tu navegador no soporta video mp4
                        </video>
                    </div>

                    {!!  $h->description !!}
                </div>
        </div>
    </div>
    @endforeach

</div>
<div class="py-3"><hr></div>
@endforeach

@endsection
