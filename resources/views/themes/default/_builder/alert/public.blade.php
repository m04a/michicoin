<div class="my-3 alert alert-{!! $fbcc->type ?? 'success' !!} d-flex align-items-center" role="alert">
    <i class="bi me-2 {!! $fbcc->icon ?? 'alarm' !!}"></i>
    <div>
        {!! $fbcc->title ?? '' !!}
    </div>
</div>