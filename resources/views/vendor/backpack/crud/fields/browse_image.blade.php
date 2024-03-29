{{-- browse server input --}}
<?php

$src = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';

?>
@include('crud::fields.inc.wrapper_start')

    <label class="d-block">{!! $field['label'] !!}</label>
	
		@include('crud::fields.inc.translatable_icon')
	
	<img src="{{url( $src )}}" class="image mx-auto mb-3 img-fluid {{$src==''?'d-none':''}}" alt=""><br>    

	<div class="input-group">
		<input
			type="text"
			name="{{ $field['name'] }}"
			value="{{ old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '' }}"
			data-init-function="bpFieldInitBrowseElement"
			data-elfinder-trigger-url="{{ url(config('elfinder.route.prefix').'/popup') }}"
			@include('crud::fields.inc.attributes')

			@if(!isset($field['readonly']) || $field['readonly']) readonly @endif
		>

		<span class="input-group-append">
			<button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-light btn-sm popup_selector"><i class="la la-cloud-upload"></i> {{ trans('backpack::crud.browse_uploads') }}</button>
			<button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-light btn-sm clear_elfinder_picker"><i class="la la-eraser"></i> {{ trans('backpack::crud.clear') }}</button>
		</span>
	</div>
	@if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

	{{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
		{{-- include browse server css --}}
		@loadOnce('packages/jquery-colorbox/example2/colorbox.css')
		@loadOnce('bpFieldInitBrowseStyle')
		<style>
			#cboxContent, #cboxLoadedContent, .cboxIframe {
				background: transparent;
			}
		</style>
		@endLoadOnce
	@endpush

    @push('crud_fields_scripts')
		{{-- include browse server js --}}
		@loadOnce('packages/jquery-colorbox/jquery.colorbox-min.js')
		@loadOnce('bpFieldInitBrowseElement')
		<script type="text/javascript">
			// this global variable is used to remember what input to update with the file path
			// because elfinder is actually loaded in an iframe by colorbox
			var elfinderTarget = false;

			// function to update the file selected by elfinder
			function processSelectedFile(filePath, requestingField) {
				elfinderTarget.val(filePath.replace(/\\/g,"/"));
				elfinderTarget.trigger('change');
				elfinderTarget.parent().parent().find('.image').attr('src','{{url('')}}/'+filePath.replace(/\\/g,"/")).removeClass('d-none');;

				elfinderTarget = false;

			}

			function bpFieldInitBrowseElement(element) {
				var triggerUrl = element.data('elfinder-trigger-url')
				var name = element.attr('name');

				element.siblings('.input-group-append').children('button.popup_selector').click(function (event) {
				    event.preventDefault();
                    element.parent().parent().find('.image').attr('src','').addClass('d-none');

				    elfinderTarget = element;

				    // trigger the reveal modal with elfinder inside
				    $.colorbox({
				        href: triggerUrl + '/' + name,
				        fastIframe: true,
				        iframe: true,
				        width: '80%',
				        height: '80%'
				    });
				});

				element.bind('select', function(event) { // called on file(s) select/unselect
					element.trigger('change');
				});

				element.siblings('.input-group-append').children('button.clear_elfinder_picker').click(function (event) {
				    event.preventDefault();
				    element.val("").trigger('change');
				});

				element.on('CrudField:disable', function(e) {
					element.siblings('.input-group-append').children('button.popup_selector').prop('disabled','disabled');
					element.siblings('.input-group-append').children('button.clear_elfinder_picker').prop('disabled','disabled');
				});

				element.on('CrudField:enable', function(e) {
					element.siblings('.input-group-append').children('button.popup_selector').removeAttr('disabled');
					element.siblings('.input-group-append').children('button.clear_elfinder_picker').removeAttr('disabled');
				});
			}

			 //En las galerias no se previsualiza la imagen preexistente, con este pequeño fix la recargamos
			 $(function(){
               window.setTimeout(() => {
                $('.js-change-browse-image-check').each(function(){
                    realVal = $(this).find('input[type=text]').val();
                    if(realVal!=''){
                        $(this).parent().find('.image').removeClass('d-none').attr('src','{{url('')}}/'+realVal);
                    }
                });
               }, 400);


            });
		</script>
		@endLoadOnce
	@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
