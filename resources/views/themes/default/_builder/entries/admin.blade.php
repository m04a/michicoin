
<div class="row">

    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="">{{__('builder.title_title')}}</label>
            <input type="text" class="form-control widget-field" name="title">
        </div>
        
    </div>
  
</div>

<script>
$(function(){
    $('#modalFnxWidgetentries').on('show.bs.modal', function () {
        loadWidgetFields('modalFnxWidgetentries');
    });


    $('#modalFnxWidgetentries .js-fnxbuilder-savewidget').click(function(){
        saveWidgetFields('modalFnxWidgetentries');
    });
});
</script>