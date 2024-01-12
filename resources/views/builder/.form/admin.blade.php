<?php 
  include(resource_path('views/builder/form/config.php'));
  include(themeConfigFile());
?>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="">{{__('builder.title_type')}}</label>
            <select id="fnxbuilderform" class="form-control widget-field" name="form">
                @foreach($forms as $form=>$label)
                <option value="{{$form}}">{{$label}}</option>
                @endforeach
            </select>
        </div>        
    </div>
    
  
</div>

<script>
$(function(){
    $('#modalFnxWidgetform').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetform');

   
    });


    $('#modalFnxWidgetform .js-fnxbuilder-savewidget').click(function(){
        setWidgetPreview('<small>'+$('#fnxbuilderform').val()+'</small>');

        saveWidgetFields('modalFnxWidgetform');

         
        });
});
</script>