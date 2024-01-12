
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <div class="controls text-center js-change-browse-image-check">
                <img src="" id="fnxbuilderpersonimageimg" class="image mx-auto mb-3 img-fluid d-none" alt=""><br>    

                <div class="input-group ">
                    <input
                        class="form-control"
                        id="fnxbuilderpersonimage"
                        type="text"
                        data-baseurl="{{url('')}}/"
                        readonly
                    >

                    <span class="input-group-append">
                        <button type="button" class="btn btn-light btn-sm popup_selector js-fnxbuilder-popup_selector" data-target="fnxbuilderpersonimage"><i class="la la-edit"></i></button>
                        <button type="button" class="btn btn-light btn-sm clear_elfinder_picker js-fnxbuilder-clear_elfinder_picker"  data-target="fnxbuilderpersonimage"><i class="la la-times"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="">{{__('builder.person_name')}}</label>
            <input type="text" id="fnxbuilderpersonname" class="form-control ">
        </div>

        <div class="form-group">
            <label for="">{{__('builder.person_job')}}</label>
            <input type="text" id="fnxbuilderpersonjob" class="form-control ">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">{{__('builder.person_description')}}</label>
            <textarea id="fnxbuilderpersondesc" class="fnxbuilder-input ckeditor form-control " data-name="text" cols="30" rows="10"></textarea>

        </div>
    </div>
</div>

<script>
$(function(){
    $('#modalFnxWidgetperson').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val().trim();
        $('#fnxbuilderpersonname').val('');
        $('#fnxbuilderpersonjob').val('');
        $('#fnxbuilderpersonimageimg').addClass('d-none');
        $('#fnxbuilderpersonimage').val('');

        try {
            var deco = JSON.parse(content);
            $('#fnxbuilderpersonname').val(deco.name);
            $('#fnxbuilderpersonjob').val(deco.job);
            CKEDITOR.instances.fnxbuilderpersondesc.setData(deco.desc);
            if(deco.image!=''){
                $('#fnxbuilderpersonimageimg').removeClass('d-none');
                $('#fnxbuilderpersonimage').val(deco.image);
                var image_url = $('#fnxbuilderpersonimage').data('baseurl') + deco.image;
                $('#fnxbuilderpersonimageimg').attr('src',image_url);
            }

        } catch (error) {
            CKEDITOR.instances.fnxbuilderpersondesc.setData('');

        }
    });


    $('#modalFnxWidgetperson .js-fnxbuilder-savewidget').click(function(){

            var widget_content = {
                image: $('#fnxbuilderpersonimage').val(),
                name: $('#fnxbuilderpersonname').val(),
                job: $('#fnxbuilderpersonjob').val(),
                desc: CKEDITOR.instances.fnxbuilderpersondesc.getData()
            };

            $('.fnxbuildercurrentcol').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

            $('#modalFnxWidgetperson').modal('hide');
            $('.fnxbuildercurrentcol').removeClass('fnxbuildercurrentcol');
            fnxBuilderSaveArea();
        });
});
</script>