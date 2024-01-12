<!-- select2 -->
@php
    $current_value = old($field['name']) ?? $field['value'] ?? $field['default'] ?? '';
    $entity_model = $crud->model;

    //if it's part of a relationship here we have the full related model, we want the key.
    if (is_object($current_value) && is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
        $current_value = $current_value;
    }


    $css = file_get_contents($field['css']);
    preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
    $result = array();
    foreach ($arr[0] as $i => $x){
        $selector = trim($arr[1][$i]);
        $selectors = explode(',', trim($selector));
        foreach ($selectors as $strSel){
            $result[] = $strSel;
        }
    }

    $options = [];

    foreach($result as $classLine){

        if (strpos($classLine, $field['find_class']) === 0) {
            $classLineParts = explode(':',$classLine);
            $options[] = str_replace('.','',$classLineParts[0]);
        }
    }
@endphp

@include('crud::fields.inc.wrapper_start')

    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <select
        name="{{ $field['name'] }}"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2Element"
        @include('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'])
        >

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

        @if (count($options))
            @foreach ($options as $option)
                @if($current_value == $option)
                    <option value="{{ $option }}" selected>{{ $option }}</option>
                @else
                    <option value="{{ $option }}">{{ $option }}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include select2 css-->
        <link href="{{ asset('packages/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ url($field['css']) }}">
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include select2 js-->
        <script src="{{ asset('packages/select2/dist/js/select2.full.min.js') }}"></script>
        @if (app()->getLocale() !== 'en')
        <script src="{{ asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js') }}"></script>
        @endif
        <script>
            function bpFieldInitSelect2Element(element) {
                // element will be a jQuery wrapped DOM node
                if (!element.hasClass("select2-hidden-accessible")) {
                    element.select2({
                        theme: "bootstrap",
                        templateResult: formatState
                    });
                }
            }
            function formatState (state) {
                if (!state.id) { return state.text; }
                var $state = $('<span><i class="{{$field['show_class'] ?? ''}} ' +  state.element.value.toLowerCase() + '"></i> ' + state.text.replace('{{$field['remove_class'] ?? ''}}','') +     '</span>');
                return $state;
            };
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
