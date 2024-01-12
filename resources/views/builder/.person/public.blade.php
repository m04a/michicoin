@if(isset($fbcc->image) && $fbcc->image!='')
<img class="img-fluid mb-3" alt="{{$fbcc->name ?? ''}}" src="{{getImage($fbcc->image,400)}}"/>
@endif
<div class="title title-sm mb-2">{{$fbcc->name ?? ''}}</div>
<div class="job-position mb-1">{{$fbcc->job ?? ''}}</div>
<div class="person-desc">
    {!! $fbcc->desc ?? '' !!}
</div>