<input type="hidden" name="form" value="tell">
{!! RecaptchaV3::field('tell') !!}

<div class="title title-sm mb-3 ">{{__('public.name')}} *</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <input type="text" class="form-control form-control-quart @error('name') is-invalid @enderror" placeholder="{{__('public.first_name')}}" required name="name">
            @error('name')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <input type="text" class="form-control form-control-quart @error('surname') is-invalid @enderror" placeholder="{{__('public.surname')}}" required name="surname">
            @error('surname')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
</div>


<div class="title title-sm mb-3 ">{{__('public.email')}} </div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <input type="email" class="form-control form-control-quart @error('email') is-invalid @enderror" placeholder="{{__('public.email_placeholder')}}"  name="email">
            @error('email')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <input type="email" class="form-control form-control-quart @error('email_confirmation') is-invalid @enderror" placeholder="{{__('public.email_confirmation_placeholder')}}"  name="email_confirmation">
            @error('email_confirmation')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="title title-sm mb-3 ">{{__('public.what_say')}} </div>
<div class="row">
    <div class="col-12 ">
        <div class="form-group-quart">
            <textarea name="comments" class="form-control form-control-quart  @error('comments') is-invalid @enderror"  cols="30" rows="10"></textarea>
            @error('comments')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
   
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <button class="btn btn-block btn-blue text-left" type="submit">{{ trans('public.send') }}</button>
    </div>
</div>
