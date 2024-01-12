<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <div class="controls text-center js-change-browse-image-check">
                <img src="" id="imgfnxbuilderwidgetimage" class="image mx-auto mb-3 img-fluid d-none" alt=""><br>    

                <div class="input-group ">
                    <input
                        class="form-control widget-field"
                        name="image"
                        id="fnxbuilderwidgetimage"
                        type="text"
                        data-baseurl="{{url('')}}/"
                        readonly
                    >

                    <span class="input-group-append">
                        <button type="button" class="btn btn-light btn-sm popup_selector js-fnxbuilder-popup_selector" data-target="fnxbuilderwidgetimage"><i class="la la-cloud-upload"></i> {{ trans('backpack::crud.browse_uploads') }}</button>
                        <button type="button" class="btn btn-light btn-sm clear_elfinder_picker js-fnxbuilder-clear_elfinder_picker"  data-target="fnxbuilderwidgetimage"><i class="la la-eraser"></i> {{ trans('backpack::crud.clear') }}</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.with_100')}}</label>
            <select  class="form-control widget-field" name="w100">
                <option value="">{{__('builder.no')}}</option>
                <option value="w-100">{{__('builder.yes')}}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">{{__('builder.with')}}</label>
            <input type="number" min="0" class="form-control widget-field" name="width">
        </div>

        <div class="form-group">
            <label for="">{{__('builder.image_alt')}}</label>
            <input type="text" class="form-control widget-field" name="alt">
        </div>
        
        <div class="form-group">
            <label for="">{{__('builder.link_new_window')}}</label>
            <select  class="form-control widget-field" name="target">
                <option value="">{{__('builder.no_new_window')}}</option>
                <option value="_blank">{{__('builder.new_window')}}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">{{__('builder.link_link')}}</label>
            <input type="text" class="form-control widget-field" name="link">
        </div>

    </div>

</div>


<script>
$(function(){
    $('#modalFnxWidgetimage').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetimage');
        $('#imgfnxbuilderwidgetimage').addClass('d-none');
        try {
            var content = $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val().trim();

            var deco = JSON.parse(content);
            if(deco.image!=''){
                $('#imgfnxbuilderwidgetimage').removeClass('d-none');
              
                var image_url = $('#fnxbuilderwidgetimage').data('baseurl') + deco.image;
                $('#imgfnxbuilderwidgetimage').attr('src',image_url);
            }
           

        } catch (error) {
            console.log(error);
        }
    });
    $('#modalFnxWidgetimage .js-fnxbuilder-savewidget').click(function(){
        setWidgetPreview('<img src="{{url('')}}/'+$('#fnxbuilderwidgetimage').val()+'" />');
        saveWidgetFields('modalFnxWidgetimage');
    });
});
</script>
