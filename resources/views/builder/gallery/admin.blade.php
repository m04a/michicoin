<div id="fnxbuildergalleryoriginal" class="d-none">
    <div class=" mb-4 rowitem"  id="fnxbuilderwidgetgitem">

        <div class="fnxbuilder-bg-tools row mb-3">
            <div class="col-6">
            <span class="fnxbuilder-tool move"><i class="la la-arrows"></i></span>
            </div>
            <div class="col-6  text-right">
                <a href="#" class="fnxbuilder-tool js-fnxbuildergallery-remove" ><i class="la la-times"></i> </a>                    
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4 mb-mb-0">
                <div class="controls ">
                    <div class="input-group d w-100">
                        <input
                            name="image"
                            class="d-none fnxbuilderwidgetgallery-input field-input  field-input-image"
                            id="fnxbuilderwidgetgallery"
                            type="text"
                            data-baseurl="{{url('')}}/"
                            readonly
                        >
                        
                    </div>
                    <div class="clearfix w-100"></div>
                    <img src=""  class="image mx-autimg-fluid w-100 d-none" alt="" height="150">
                    <div class="fnxbuilder-bg-tools text-right o mb-3 ">
                            <a href="#" class="fnxbuilder-tool  js-fnxbuilder-popup_selector" data-target="fnxbuilderwidgetgallery"><i class="la la-edit"></i> </a>                                                
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="row d-none">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="align" class="form-control field-option field-input field-input-align">
                                <option value="align-items-start justify-content-start">{{__('builder.top_left')}}</option>
                                <option value="align-items-start justify-content-center text-center">{{__('builder.top_center')}}</option>
                                <option value="align-items-start justify-content-end text-end text-right">{{__('builder.top_right')}}</option>
                                <option value="align-items-center justify-content-start">{{__('builder.center_left')}}</option>
                                <option value="align-items-center justify-content-center  text-center">{{__('builder.center_center')}}</option>
                                <option value="align-items-center justify-content-end text-end text-right">{{__('builder.center_right')}}</option>
                                <option value="align-items-end justify-content-start">{{__('builder.bottom_left')}}</option>
                                <option value="align-items-end justify-content-center text-center">{{__('builder.bottom_center')}}</option>
                                <option value="align-items-end justify-content-end text-end text-right">{{__('builder.bottom_right')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="overlay" class="form-control field-option field-input field-input-overlay">
                                <option value="">{{__('builder.no_overlay')}}</option>
                                <option value="overlay_dark">{{__('builder.overlay_dark')}}</option>
                                <option value="overlay_light">{{__('builder.overlay_light')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
              

                <div class="form-group">
                    <input type="text" placeholder="{{__('builder.title')}}" name="title" class="form-control field-input  field-input-title">
                </div>
                <div class="form-group d-none">
                    <label for="">{{__('builder.title_color')}}</label>
                    <input type="color" placeholder="{{__('builder.title_color')}}" name="titlecolor" class="form-control field-input field-input-titlecolor">
                </div>
                <div class="form-group">
                    <input type="subtitle" placeholder="{{__('builder.subtitle')}}" name="subtitle" class="form-control field-input  field-input-subtitle">
                </div>
                <div class="form-group d-none">
                <label for="">{{__('builder.subtitle_color')}}</label>

                    <input type="color" placeholder="{{__('builder.subtitle_color')}}" name="subtitlecolor" class="form-control field-input field-input-subtitlecolor">
                </div>
                <div class="form-group">
                    <input type="btn" placeholder="{{__('builder.btn')}}" name="btn" class="form-control field-input  field-input-btn">
                </div>
                <div class="form-group">
                    <input type="link" placeholder="{{__('builder.link')}}" name="link" class="form-control field-input field-input-link">
                </div>
                <div class="form-group d-none">
                <label for="">{{__('builder.btncolor')}}</label>
                    <input type="color" placeholder="{{__('builder.btncolor')}}" name="btncolor" class="form-control field-input field-input-btncolor">
                </div>
                <div class="form-group d-none">

                <label for="">{{__('builder.btnbgcolor')}}</label>
                    <input type="color" placeholder="{{__('builder.btnbgcolor')}}" name="btnbgcolor" class="form-control field-input field-input-btnbgcolor">
                </div>
               
            </div>
        </div>


    </div>


</div>


<div class="row" id="fnxbuildergalleryoptions">
    <div class="col-12 col-md-6 col-lg-4  d-none">
        <div class="form-group">
            <label for="">{{__('builder.full_screen')}}</label>
            <select name="fs" class="form-control field-option field-option-fs">
                <option value="0">{{__('builder.no')}}</option>
                <option value="1">{{__('builder.yes')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-6 col-lg-4 d-none">
        <div class="form-group">
            <label for="">{{__('builder.height')}}</label>
            <input type="number" in="0" step="1" name="height" class="field-option field-option-height form-control text-right">
        </div>        
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="">{{__('builder.controls')}}</label>
            <select name="controls" class="form-control field-option field-option-controls">
                <option value="0">{{__('builder.no')}}</option>
                <option value="1">{{__('builder.yes')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="">{{__('builder.navigation')}}</label>
            <select name="navigation" class="form-control field-option field-option-navigation">
                <option value="0">{{__('builder.no')}}</option>
                <option value="1">{{__('builder.yes')}}</option>
            </select>
        </div>        
    </div>
  
</div>

<div id="fnxbuildergalleryholder">


    
</div>

<div class="text-center mt-3">
    <a class="fnxbuilder-action js-fnxbuildergallery-add" href="#">
        <i class="la la-plus "></i>
    </a>
</div>



<script>
$(function(){
//parts dels scripts els carrega el widget imatge


    $( "#fnxbuildergalleryholder" ).sortable({
        handle: ".move"
    });

    $('#modalFnxWidgetgallery').on('click','.js-fnxbuildergallery-remove',function(e){
        e.preventDefault();
        $(this).parent().parent().parent().remove();
    });

    $('.js-fnxbuildergallery-add').click(function(){
        new_item = $('#fnxbuildergalleryoriginal').html();
        new_id = 'fnxbuilderwidgetgallery' + $('#fnxbuildergalleryholder .image').length;
        new_item = new_item.replace(/fnxbuilderwidgetgallery/g,new_id);

        new_id = 'fnxbuilderwidgetgitem' + $('#fnxbuilderwidgetgitem').length;
        new_item = new_item.replace(/fnxbuilderwidgetgitem/g,new_id);

        $('#fnxbuildergalleryholder').append(new_item);
    });
    
    

    $('#modalFnxWidgetgallery').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val().trim();
        $('#fnxbuildergalleryholder').empty();
        try {
            var decoded_content = JSON.parse(content);
            $.each(decoded_content.options,function(i,v){   
                $('#fnxbuildergalleryoptions').find('.field-option-'+i).val(v);
            });    
            
            $.each(decoded_content.items,function(i,v){                
                new_item = $('#fnxbuildergalleryoriginal').html();
                new_id = 'fnxbuilderwidgetgallery' + i;
                new_item = new_item.replace(/fnxbuilderwidgetgallery/g,new_id);      
                
                new_id = 'fnxbuilderwidgetgitem' + i;
                new_item = new_item.replace(/fnxbuilderwidgetgitem/g,new_id); 
                $('#fnxbuildergalleryholder').append(new_item);

                $.each(v,function(k,f){
                    $('#'+new_id).find('.field-input-'+k).val(f);
                });

                img_url = '{{url('')}}/'+v.image;
                $('#'+new_id).find('.image').removeClass('d-none').attr('src',img_url);

            });
        } catch (error) {
            CKEDITOR.instances.fnxbuilderwidgettext.setData('');
        }
    });


    $('#modalFnxWidgetgallery .js-fnxbuilder-savewidget').click(function(){
            var widget_content = {};
            widgetPreview = '<small>';
            $('#fnxbuildergalleryholder .rowitem').each(function(i){
                current ={};
                $(this).find('.field-input').each(function(){
                    current[$(this).attr('name')] = $(this).val();
                });
                widget_content[i] = current;
                widgetItemsrc = $(this).find('.field-input-image').val();
                widgetPreview += '<img src="{{url('')}}/'+widgetItemsrc+'"/>';
            });

            var widget = {};
            widget['items'] = widget_content;
            widget['options'] = {};


            $('#fnxbuildergalleryoptions .field-option').each(function(i){
                widget['options'][$(this).attr('name')] = $(this).val();
            });         
            
            $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val(JSON.stringify(widget));

            $('#modalFnxWidgetgallery').modal('hide');

            widgetPreview += '</small>';
            setWidgetPreview(widgetPreview);



            $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
            fnxBuilderSaveArea();
        });

});
</script>