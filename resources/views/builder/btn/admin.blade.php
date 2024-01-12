
<?php 
  include(resource_path('views/builder/btn/config.php'));
 include(themeConfigFile());
?>
  <div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.btn_type')}}</label>
            <select id="fnxbuilderbtntype" class="form-control widget-field" name="type">
                @foreach($btnClasses as $btn=>$btn_label)
                <option value="{{$btn}}">{{$btn_label}}</option>
                @endforeach
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.btn_size')}}</label>
            <select id="fnxbuilderbtnsize" class="form-control widget-field" name="size">
                <option value="">{{__('builder.btn_regular')}}</option>
                <option value="btn-lg">{{__('builder.btn_lg')}}</option>
                <option value="btn-sm">{{__('builder.btn_sm')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.btn_target_new')}}</label>
            <select id="fnxbuilderbtntarget" class="form-control widget-field" name="target">
                <option value="0">{{__('builder.no')}}</option>
                <option value="1">{{__('builder.yes')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.btn_fw')}}</label>
            <select id="fnxbuilderbtnfw" class="form-control widget-field" name="fw">
                <option value="0">{{__('builder.no')}}</option>
                <option value="1">{{__('builder.yes')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.align')}}</label>
            <select id="fnxbuilderbtnalign" class="form-control widget-field" name="align">
                <option value="text-right text-start">{{__('builder.align_left')}}</option>
                <option value="text-center">{{__('builder.align_center')}}</option>
                <option value="text-end text-right">{{__('builder.align_right')}}</option>
            </select>
        </div>        
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.title')}}</label>
            <input type="text" id="fnxbuilderbtntitle" class="form-control widget-field" name="title">
        </div>        
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.link')}}</label>
            <input type="text" id="fnxbuilderbtnlink" class="form-control widget-field" name="link">
        </div>        
    </div>
  
</div>

<script>
$(function(){
    $('#modalFnxWidgetbtn').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetbtn');
    });


    $('#modalFnxWidgetbtn .js-fnxbuilder-savewidget').click(function(){
        widgetPreview = '<small>';
        widgetPreview += $('#fnxbuilderbtntitle').val()+' ('+ $('#fnxbuilderbtnlink').val()+')';
        widgetPreview += '</small>';

        setWidgetPreview(widgetPreview);

        saveWidgetFields('modalFnxWidgetbtn');
        });
});
</script>