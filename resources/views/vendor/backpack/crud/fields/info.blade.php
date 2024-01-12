<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    <small> {{  $field['value'] ?? ''  }}</small>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    @include('crud::fields.inc.wrapper_end')

