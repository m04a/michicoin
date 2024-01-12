
<?php
    $page_model = 'App\Models\Page';
    $active_pages = $page_model::all();
    $sel_page = $entry->value ?? '';
    if($sel_page==''){
        $sel_page = old($field['name']) ?? $field['value'] ?? $field['default'] ?? '';
    }
?>

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
        <select
            class="form-control"
            name="{{ $field['name'] }}"
            >
            @if (!count($active_pages))
                <option value="">-</option>
            @else
                @foreach ($active_pages as $key => $page)
                    <option value="{{ $page->id }}"
                        @if ($page->id==$sel_page)
                                selected
                        @endif
                    >{{ $page->title }}</option>
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
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')

    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
