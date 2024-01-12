<input type="hidden" name="form" value="vespa">
{!! RecaptchaV3::field('vespa') !!}

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_date')}} *</label>
            <input type="date" class="form-control form-control-quart @error('detection_date') is-invalid @enderror" required name="detection_date">
            @error('detection_date')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_type')}}</label>
            <select class="form-control form-control-quart @error('detection_type') is-invalid @enderror" name="detection_type">
            
            </select>
            @error('detection_type')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_location')}} *</label>
            <input type="text"  class="form-control form-control-quart @error('detection_location') is-invalid @enderror" required name="detection_location">
            @error('detection_location')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_ubication')}}</label>
            <input type="text"  class="form-control form-control-quart @error('detection_ubication') is-invalid @enderror" name="detection_ubication">
            @error('detection_ubication')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_coord_x')}}</label>
            <input type="text" class="form-control form-control-quart @error('detection_coord_x') is-invalid @enderror" name="detection_coord_x">
            @error('detection_coord_x')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_coord_y')}}</label>
            <input type="text"  class="form-control form-control-quart @error('detection_coord_y') is-invalid @enderror" name="detection_coord_y">
            @error('detection_coord_y')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="form-group-quart">
            <label for="">{{__('public.detection_observations')}}</label>
            <input type="text"  class="form-control form-control-quart @error('detection_observations') is-invalid @enderror" name="detection_observations">
            @error('detection_observations')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <hr>
    </div>
    <div class="col-12">
        <div class="title title-sm mb-4">{{__('public.observer_info')}}</div>
    </div>

      <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.full_name')}} *</label>
            <input type="text" class="form-control form-control-quart @error('full_name') is-invalid @enderror" required name="full_name">
            @error('full_name')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.phone')}}</label>
            <input type="text"  class="form-control form-control-quart @error('phone') is-invalid @enderror" name="phone">
            @error('phone')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>


    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.email')}}</label>
            <input type="email" class="form-control form-control-quart @error('email') is-invalid @enderror" name="email">
            @error('email')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-group-quart">
            <label for="">{{__('public.extended_info')}}</label>
            <input type="text"  class="form-control form-control-quart @error('extended_info') is-invalid @enderror" name="extended_info">
            @error('extended_info')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 ">
        <div class="form-group-quart">
            <label for="">{{__('public.atatch_image')}} *</label>
            <input type="file"  class="form-control form-control-quart @error('atatch_image') is-invalid @enderror" required name="atatch_image">
            @error('atatch_image')
                <div class="invalid-feedback">{{ trans('public.required_field') }}</div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6">
       <button class="btn btn-block btn-blue text-left" type="submit">{{ trans('public.send') }}</button>
    </div>

</div>