
<div class="row">

    <div class="col-4">
        <div class="form-group">
            <label for="">{{__('builder.box_type')}}</label>
            <select id="fnxbuilderboxtype" class="form-control">
                <option value="blue">{{__('builder.box_blue')}}</option>
            </select>
        </div>
    </div>


    <div class="col-12">
        <div class="form-group">
            <label for="">{{__('builder.link_description')}}</label>
            <textarea  id="fnxbuilderboxdescription"  rows="3" class="form-control"></textarea>
        </div>        
    </div>
</div>

<script>
$(function(){
    $('#modalFnxWidgetbox').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val().trim();
        $('#fnxbuilderboxtype').val('blue');
        $('#fnxbuilderboxdescription').val('');


        try {
            var deco = JSON.parse(content);
            $('#fnxbuilderboxtype').val(deco.type);
            $('#fnxbuilderboxdescription').val(deco.description);


        } catch (error) {
           
        }
    });


    $('#modalFnxWidgetbox .js-fnxbuilder-savewidget').click(function(){

            var widget_content = {
                type: $('#fnxbuilderboxtype').val(),
                description: $('#fnxbuilderboxdescription').val()
            };

            $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

            $('#modalFnxWidgetbox').modal('hide');
            $('.fnxbuildercurrentcol').removeClass('fnxbuildercurrentcol');
            fnxBuilderSaveArea();
        });
});
</script>