
<div class="{{ $fbcc->align ?? '' }}">

<a href="{{ $fbcc->link ?? '#' }}" class="btn {{ $fbcc->size ?? '' }} {{ $fbcc->type ?? '' }} {{ isset($fbcc->fw) && $fbcc->fw?'w-100 d-block':'' }}" {{ isset($fbcc->target) && $fbcc->target?'target="_blank"':'' }}>
{{ $fbcc->title ?? '' }}
</a>

</div>