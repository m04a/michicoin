<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.title_type')}}</label>
            <select  class="form-control widget-field" name="type">
                @foreach($titleClasses as $k=>$v)
                <option value="{{$k}}">{{$v}}</option>
                @endforeach
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.title_align')}}</label>
            <select  class="form-control widget-field" name="align">
                <option value="text-left text-start">{{__('builder.title_align_left')}}</option>
                <option value="text-center">{{__('builder.title_align_center')}}</option>
                <option value="text-right text-end">{{__('builder.title_align_right')}}</option>
            </select>
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.title_tag')}}</label>
            <select  class="form-control widget-field" name="tag">
                <option value="div">DIV</option>
                <option value="h1">H1</option>
                <option value="h2">H2</option>
                <option value="h3">H3</option>
                <option value="h4">H4</option>
                <option value="h5">H5</option>
                <option value="h6">H6</option>
            </select>
        </div>           
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.link_new_window')}}</label>
            <select  class="form-control widget-field" name="target">
                <option value="">{{__('builder.no_new_window')}}</option>
                <option value="_blank">{{__('builder.new_window')}}</option>
            </select>
        </div>
    </div>    
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.link_link')}}</label>
            <input type="text" class="form-control widget-field" name="link">
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="">{{__('builder.title_title')}}</label>
            <input type="text" class="form-control widget-field" id="fnxbldtitle" name="title">
        </div>
        
    </div>
  
</div>

<script>
$(function(){
    $('#modalFnxWidgettitle').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgettitle');
    });


    $('#modalFnxWidgettitle .js-fnxbuilder-savewidget').click(function(){
        setWidgetPreview('<small>'+$('#fnxbldtitle').val()+'</small>');

        saveWidgetFields('modalFnxWidgettitle');
    });
});
</script>