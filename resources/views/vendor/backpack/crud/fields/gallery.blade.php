@php
$multiple = true;
$sortable = true;
$value = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';

$text_fields = $field['text_fields'] ?? [];

if (!$multiple && is_array($value)) {
    $value = array_first($value);
}

$field['wrapper'] = $field['wrapperAttributes'] ?? [];
$field['wrapper']['data-init-function'] = $field['wrapper']['data-init-function'] ?? 'bpFieldInitBrowseMultipleElement';
$field['wrapper']['data-elfinder-trigger-url'] = $field['wrapper']['data-elfinder-trigger-url'] ?? url(config('elfinder.route.prefix').'/popup/'.$field['name'].'?multiple=1');

if (!isset($field['wrapperAttributes']) || !isset($field['wrapperAttributes']['data-init-function']))
{
    $field['wrapperAttributes']['data-init-function'] = 'bpFieldInitBrowseMultipleElementGallery';

    if ($multiple) {
        $field['wrapperAttributes']['data-popup-title'] = trans('backpack::crud.select_files');
        $field['wrapperAttributes']['data-multiple'] = "true";
    } else {
        $field['wrapperAttributes']['data-popup-title'] = trans('backpack::crud.select_file');
        $field['wrapperAttributes']['data-multiple'] = "false";
    }
    $field['wrapperAttributes']['data-only-mimes'] = json_encode(['image']);
    $field['wrapperAttributes']['sortable'] = $sortable?"true":"false";

}
$values = (array)$value;



usort($values, "sort_object_by_position");

@endphp

@include('crud::fields.inc.wrapper_start')

    <div><label>{!! $field['label'] !!}</label></div>
    @include('crud::fields.inc.translatable_icon')
    @if ($multiple)
        <div class="list">
            @foreach( $values as $pos=>$v)
                @if ($v)
                <?php 
                    $v = (array)$v;
                ?>
                    <div class="row row-gal">
                        <div class="col-4">
                            <input type="hidden" value="{{$v['image'] ?? ''}}" name="{{ $field['name'] }}[{{$pos}}][image]" >  
                            <img  src="{{url($v['image'] ?? '')}}"   class="gallery-img">
                            <input type="hidden" value="{{$v['position'] ?? ''}}" name="{{ $field['name'] }}[{{$pos}}][position]" class="position">  
                        </div>
                        <div class="col-6">
                            @foreach($text_fields as $tf)
                            <div class="form-group">
                                <input type="text" value="{{$v[$tf] ?? ''}}" name="{{ $field['name'] }}[{{$pos}}][{{$tf}}]"  class="form-control" placeholder="{{__('gallery.'.$tf)}}">  
                            </div>
                            @endforeach

                        </div>
                        <div class="col-2">
                        <button type="button" class="browse remove btn btn-sm btn-light">
                                <i class="la la-trash"></i>
                            </button>
                            @if ($sortable)
                                <button type="button" class="browse move btn btn-sm btn-light"><span class="la la-sort"></span></button>
                            @endif
                        </div>
                       
            
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <input type="text" name="{{ $field['name'] }}" value="{{ $value }}" @include('crud::fields.inc.attributes') readonly>
    @endif

    <div class="btn-group" role="group" aria-label="..." style="margin-top: 3px;">
        <button type="button" class="browse popup btn btn-sm btn-light">
            <i class="la la-cloud-upload"></i>
            {{ trans('backpack::crud.browse_uploads') }}
        </button>
        <button type="button" class="browse clear btn btn-sm btn-light">
            <i class="la la-eraser"></i>
            {{ trans('backpack::crud.clear') }}
        </button>
    </div>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

    <script type="text/html" data-marker="browse_multiple_template">
        <div class="row row-gal">
            <div class="col-4">
                <input type="hidden" name="{{ $field['name'] }}[%][image]" class="input_image" readonly>
                <input type="hidden" value="%" name="{{ $field['name'] }}[%][position]" class="position">  
                <img  src="" class="gallery-img">
            </div>
            <div class="col-6">
                @foreach($text_fields as $tf)
                <div class="form-group">
                    <input type="text"  name="{{ $field['name'] }}[%][{{$tf}}]" @include('crud::fields.inc.attributes') placeholder="{{__('gallery.'.$tf)}}">  
                </div>
                @endforeach
            </div>
            <div class="col-2">
                <button type="button" class="browse remove btn btn-sm btn-light">
                    <i class="la la-trash"></i>
                </button>
                <button type="button" class="browse move btn btn-sm btn-light"><span class="la la-sort"></span></button>

            </div>
        </div>
    </script>
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
        <link href="{{ asset('packages/jquery-colorbox/example2/colorbox.css') }}" rel="stylesheet" type="text/css" />
        <style>
            #cboxContent, #cboxLoadedContent, .cboxIframe {
                background: transparent;
            }
        </style>
    @endpush

    @push('crud_fields_scripts')
        <!-- include browse server js -->
        <script src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('packages/jquery-colorbox/jquery.colorbox-min.js') }}"></script>


        <script>
            function generate_positions($list){
                pos=0;
                $list.find('.row-gal').each(function(){
                    $(this).find('.position').val(pos++);
                });
            }


            function bpFieldInitBrowseMultipleElementGallery(element) {
                var $template = element.find("[data-marker=browse_multiple_template]").html();
                var $list = element.find(".list");
                var $popupButton = element.find(".popup");
                var $clearButton = element.find(".clear");
                var $removeButton = element.find(".remove");
                var $input = element.find('input[data-marker=multipleBrowseInput]');
                var $popupTitle = element.attr('data-popup-title');
                var $onlyMimesArray = JSON.parse(element.attr('data-only-mimes'));
                var $multiple = element.attr('data-multiple');
                var $sortable = element.attr('sortable');
                var pos = 10;

                if($sortable){
                    $list.sortable({
                        handle: 'button.move',
                        cancel: '',
                        update: function( event, ui ) {
                            generate_positions($list);
                        }
                    });
                }

                element.on('click', 'button.popup', function (event) {
                    event.preventDefault();

                    var div = $('<div>');
                    div.elfinder({
                        lang: '{{ \App::getLocale() }}',
                        customData: {
                            _token: '{{ csrf_token() }}'
                        },
                        url: '{{ route("elfinder.connector") }}',
                        soundPath: '{{ asset('/packages/barryvdh/elfinder/sounds') }}',
                        dialog: {
                            width: 900,
                            modal: true,
                            title: $popupTitle,
                        },
                        resizable: false,
                        onlyMimes: $onlyMimesArray,
                        commandsOptions: {
                            getfile: {
                                multiple: $multiple,
                                oncomplete: 'destroy'
                            }
                        },
                        getFileCallback: function (files) {
                            if ($multiple) {
                                files.forEach(function (file) {
                                    var newInput = $($template);
                                    newInput.find('.input_image').val(file.path);
                                    newInput.find('img').attr('src','{{url('/')}}/' + file.path);

                                   newInput.find('input').each(function(){
                                        base_name = $(this).attr('name');
                                        new_name = base_name.replace('%',pos);
                                        $(this).attr('name',new_name);
                                    });
                                    pos++;


                                    $list.append(newInput);

                                    generate_positions($list);
                                });

                                if($sortable){
                                    $list.sortable("refresh")
                                }
                            } else {
                                $input.val(files.path);
                            }

                            $.colorbox.close();
                        }
                    }).elfinder('instance');

                    // trigger the reveal modal with elfinder inside
                    $.colorbox({
                        href: div,
                        inline: true,
                        width: '80%',
                        height: '80%'
                    });
                });

                element.on('click', 'button.clear', function (event) {
                    event.preventDefault();

                    if ($multiple) {
                        $input.parents('.row-gal').remove();
                    } else {
                        $input.val('');
                    }
                });

                if ($multiple) {
                    element.on('click', 'button.remove', function (event) {
                        event.preventDefault();
                        $(this).parents('.row-gal').remove();
                    });
                }
            }
        </script>
    @endpush
@endif

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
