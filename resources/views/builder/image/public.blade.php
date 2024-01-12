
@if(isset($fbcc->link) && $fbcc->link!='')
<a href="{{$fbcc->link}}"  {{$fbcc->target!=''?'target="'.$fbcc->target.'"':''}} class="img-link">
@endif
<img src="{{ $fbcc->image }}" @if(isset($fbcc->width) && $fbcc->width!='' && $fbcc->width!='0') width="{{$fbcc->width}}" @endif class="img-fluid {{$fbcc->w100 ?? ''}}" alt="{{ $fbcc->alt }}" >
@if(isset($fbcc->link) && $fbcc->link!='')
</a>
@endif