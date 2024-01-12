@component('mail::message')
{{trans('mails.reset_instructions')}}

@component('mail::button', ['url' => $reset_link])
{{trans('mails.restore')}}
@endcomponent

@endcomponent
