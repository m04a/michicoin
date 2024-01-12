
@if(isset($fbcc->link) && $fbcc->link!='')
<a href="{{$fbcc->link}}"  {{$fbcc->target!=''?'target="'.$fbcc->target.'"':''}} class="img-link">
@endif
<div class="{!! $fbcc->type ?? '' !!}  {!! $fbcc->align ?? '' !!}" >{!! $fbcc->title ?? ''!!}</div>
@if(isset($fbcc->link) && $fbcc->link!='')
</a>
@endif