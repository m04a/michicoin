
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.link_title')}}</label>
            <input type="text" id="fnxbuilderlinktitle" class="form-control">
        </div>        
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.link_name')}}</label>
            <input type="text" id="fnxbuilderlinkname" class="form-control">
        </div>
        
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="">{{__('builder.link_new_window')}}</label>
            <select id="fnxbuilderlinktarget" class="form-control">
                <option value="">{{__('builder.no_new_window')}}</option>
                <option value="_blank">{{__('builder.new_window')}}</option>
            </select>
        </div>
    </div>
    <div class="col-8">
        <div class="form-group">
            <label for="">{{__('builder.link_link')}}</label>
            <div class="input-group ">
                <input type="text" id="fnxbuilderlinklink" class="form-control" >
                <span class="input-group-append">
                    <button type="button" class="btn btn-light btn-sm popup_selector js-fnxbuilder-popup_selector" data-target="fnxbuilderlinklink"><i class="la la-folder-open"></i> {{ trans('builder.browse') }}</button>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <label for="">{{__('builder.link_description')}}</label>
            <textarea  id="fnxbuilderlinkdesc"  rows="3" class="form-control"></textarea>
        </div>        
    </div>
</div>

<script>
$(function(){
    $('#modalFnxWidgetlink').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val().trim();
        $('#fnxbuilderlinktitle').val('');
        $('#fnxbuilderlinkname').val('');
        $('#fnxbuilderlinkdesc').val('');
        $('#fnxbuilderlinklink').val('');
        $('#fnxbuilderlinktarget').val('');

        try {
            var deco = JSON.parse(content);
            $('#fnxbuilderlinktitle').val(deco.title);
            $('#fnxbuilderlinkname').val(deco.name);
            $('#fnxbuilderlinkdesc').val(deco.desc);
            $('#fnxbuilderlinklink').val(deco.link);
            $('#fnxbuilderlinktarget').val(deco.target);

        } catch (error) {
           
        }
    });


    $('#modalFnxWidgetlink .js-fnxbuilder-savewidget').click(function(){

            var widget_content = {
                title: $('#fnxbuilderlinktitle').val(),
                name: $('#fnxbuilderlinkname').val(),
                desc: $('#fnxbuilderlinkdesc').val(),
                link:  $('#fnxbuilderlinklink').val(),
                target:  $('#fnxbuilderlinktarget').val()

            };

            $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

            $('#modalFnxWidgetlink').modal('hide');
            $('.fnxbuildercurrentcol').removeClass('fnxbuildercurrentcol');
            fnxBuilderSaveArea();
        });
});
</script>