

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
    <input
    	type="text"
        data-fnx-field-id="TRUE"
        readonly
    	name="{{ $field['name'] }}"
        value="{{ old($field['name']) ?? $field['value'] ?? $field['default'] ?? '' }}"
        @include('crud::fields.inc.attributes')
    	>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

@push('crud_fields_scripts')
<script>
    function createIds(event, ui){
        var boxes = $( ".container-repeatable-elements" );
        boxes.each(function(){
            var sons = $(this).find('input[data-fnx-field-id=TRUE]');
            var lastId = 1;
            var currId = 0;
            var i = 1;
            sons.each(function(){
                currId = $(this).val();
                if(currId >= lastId){
                    lastId = parseInt(currId)+1;
                }
            });

            sons.each(function(){
                currId = $(this).val();
                if(currId == 0){
                    $(this).val(lastId++);
                }
            });

        });
    }
    function waitCreateIds(){
        setTimeout(() => {
                createIds();
        }, 500);
    }
    waitCreateIds();
 
    $('body').on('click','.add-repeatable-element-button',waitCreateIds);

</script>
@endpush

@endif