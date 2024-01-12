
<div class="row">

<div class="col-12">
    <div class="form-group">
        <label for="">{{__('builder.address_name')}}</label>
        <input type="text" class="form-control" id="fnxbuilderaddressname">
    </div>
</div>


<div class="col-12">
    <div class="form-group">
        <label for="">{{__('builder.address_info')}}</label>
        <textarea  id="fnxbuilderaddressinfo"  rows="3" class="form-control ckeditor"></textarea>
    </div>        
</div>
</div>

<script>
$(function(){




$('#modalFnxWidgetaddress').on('show.bs.modal', function () {
    var content = $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val().trim();
    $('#fnxbuilderaddressname').val('');
    $('#fnxbuilderaddressinfo').val('');


    try {
        var deco = JSON.parse(content);
        $('#fnxbuilderaddressname').val(deco.name);
        CKEDITOR.instances.fnxbuilderaddressinfo.setData(deco.info);


    } catch (error) {
       
    }
});


$('#modalFnxWidgetaddress .js-fnxbuilder-savewidget').click(function(){

        var widget_content = {
            name: $('#fnxbuilderaddressname').val(),
            info: CKEDITOR.instances.fnxbuilderaddressinfo.getData()

        };

        $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

        $('#modalFnxWidgetaddress').modal('hide');
        $('.fnxbuildercurrentcol').removeClass('fnxbuildercurrentcol');
        fnxBuilderSaveArea();
    });
});
</script>