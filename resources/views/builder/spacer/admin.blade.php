
<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.spacer_space')}} XS</label>
            <input type="number" in="0" step="1" id="fnxbuilderspacerspacexs" class="form-control text-right widget-field" name="space_xs">
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.spacer_space')}} MD</label>
            <input type="number" in="0" step="1" id="fnxbuilderspacerspacemd" class="form-control text-right widget-field" name="space_md">
        </div>        
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="">{{__('builder.spacer_space')}} LG</label>
            <input type="number" in="0" step="1" id="fnxbuilderspacerspacelg" class="form-control text-right widget-field" name="space_lg">
        </div>        
    </div>
</div>

<script>
$(function(){
    $('#modalFnxWidgetspacer').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetspacer');

    
    });


    $('#modalFnxWidgetspacer .js-fnxbuilder-savewidget').click(function(){
        setWidgetPreview('<small>'+$('#fnxbuilderspacerspacexs').val()+'/'+$('#fnxbuilderspacerspacemd').val()+'/'+$('#fnxbuilderspacerspacelg').val()+'px</small>');
        saveWidgetFields('modalFnxWidgetspacer');
    });
});
</script>