
<?php 
  include(resource_path('views/builder/title/config.php'));
  include(themeConfigFile());
    $alertTypes = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark'
    ];
  ?>
<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.title_type')}}</label>
            <select  class="form-control widget-field" name="type">
                @foreach($alertTypes as $type)
                <option value="{{$type}}">{{$type}}</option>                
                @endforeach
            </select>
        </div>        
    </div>

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.icon')}}</label>
            <select  class="form-control widget-field js-select2-icons" name="icon">
                @foreach($icon_options as $icon)
                <option value="{{$icon}}">{{$icon}}</option>                
                @endforeach
            </select>
        </div>        
    </div>

    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="">{{__('builder.title')}}</label>
            <input type="text" class="form-control widget-field" name="title">
        </div>
        
    </div>
  
</div>

<script>
$(function(){
    $('#modalFnxWidgetalert').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetalert');
    });


    $('#modalFnxWidgetalert .js-fnxbuilder-savewidget').click(function(){
        saveWidgetFields('modalFnxWidgetalert');
    });
});
</script>