<form  role="form" method="post" action="contact">
@csrf

@if ($errors->any())
<div class="alert alert-danger">
{{trans('public.contact_error')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@include('builder.form.forms.'.$fbcc->form)

</form>