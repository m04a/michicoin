<?php 
    $entries = \App\Models\Entry::with('fnx_url')->where('published',1)->where('published_at','<=',date('YmdHis'))->orderBy('published_at','desc')->take(8)->get();
?>
<section>
    <div class="container">
        <div class=" tns-controls-lat p-3 p-md-5">
            <div id="sliderNews" class="mt-4 ">
                @foreach($entries as $entry)
                <a href={{$entry->url}}" class="item ">
                    <div class="shadow">
                    <div class="item-image">
                        <img src="{{$entry->getExtra('image')}}" class="w-100" alt="">
                        <div class="item-meta">
                        <div> <div class="item-meta-day">{{$entry->published_at->format('d')}}</div>
                        {{$entry->published_at->format('M')}}</div>
                        </div>
                    
                    </div>
                    <div class="item-box">
                        <div class="item-title">{{$entry->title}} </div>
                        <div class="item-resume py-3">{{$entry->resume}}</div>
                    
                    </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>