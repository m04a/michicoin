<div class="link-title">
    {{ $fbcc->title }}
</div>
<div class="quart-separator"></div>
<a href="{{$fbcc->link}}"  {{$fbcc->target!=''?'target="'.$fbcc->target.'"':''}} class="link-link">{{ $fbcc->name }}</a>
<div class="link-description">{{ $fbcc->desc }}</div>