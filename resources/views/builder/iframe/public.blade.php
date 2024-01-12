@if($bsversion==5)
<div class="ratio ratio-{!! str_replace('by','x',$fbcc->ratio) !!}  {!! $fbcc->class ?? '' !!}">
    {!! $fbcc->iframe ?? '' !!}
</div>
@else
<div class="embed-responsive embed-responsive-{!! $fbcc->ratio !!}  {!! $fbcc->class ?? '' !!}">
    {!! $fbcc->iframe ?? '' !!}
</div>
@endif