
<?php 
  include(resource_path('views/builder/iframe/config.php'));
  include(themeConfigFile());
?>
<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.iframe_ratio')}}</label>
            <select  class="form-control widget-field" name="ratio">
                @foreach($ratios as $ratio=>$label)
                <option value="{{$ratio}}">{{$label}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.class')}}</label>
            <input type="text" name="class" class="form-control widget-field">
        </div>        
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">{{__('builder.iframe_code')}}</label>
            <textarea  rows="3" class="form-control widget-field" id="fnxbldiframe" name="iframe"></textarea>
        </div>        
    </div>
</div>

<script>
$(function(){
    $('#modalFnxWidgetiframe').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetiframe');
    });


    $('#modalFnxWidgetiframe .js-fnxbuilder-savewidget').click(function(){
        setWidgetPreview('<small>'+$('#fnxbldiframe').val().replace(/</g, '&lt;').replace(/>/g, '&gt;')+'</small>');

        saveWidgetFields('modalFnxWidgetiframe');
        });
});
</script>