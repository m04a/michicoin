<textarea id="fnxbuilderwidgettext" class="fnxbuilder-input form-control " data-name="text" cols="30" rows="10"></textarea>

<script src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>

<script>
$(function(){
 /*   $.fn.modal.Constructor.prototype._enforceFocus = function _enforceFocus() {
    var _this4 = this;
    $(document).off(Event.FOCUSIN).on(Event.FOCUSIN, function (event) {
        if (
            document !== event.target
            && _this4._element !== event.target
            && $(_this4._element).has(event.target).length === 0
            && !$(event.target.parentNode).hasClass('cke_dialog_ui_input_select')
            && !$(event.target.parentNode).hasClass('cke_dialog_ui_input_text')
        ) {
            _this4._element.focus();
        }
    });
};*/
    
    $('#fnxbuilderwidgettext').ckeditor({
        'extraPlugins' : 'embed,widget,justify',
        'filebrowserBrowseUrl' : '{{backpack_url('elfinder/ckeditor')}}',
        'embed_provider' :  "//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}"
    });

    $('#modalFnxWidgettext').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val().trim();
        try {
            var decoded_content = JSON.parse(content);
            $.each(decoded_content,function(i,v){
                if(i=='text'){
                    //LOAD DATA FROM content
                    CKEDITOR.instances.fnxbuilderwidgettext.setData(v);
                }
            });
        } catch (error) {
            CKEDITOR.instances.fnxbuilderwidgettext.setData('');
        }
    });


    $('#modalFnxWidgettext .js-fnxbuilder-savewidget').click(function(){

            var text = CKEDITOR.instances.fnxbuilderwidgettext.getData();

            var widget_content = {text: text};

            $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

            $('#modalFnxWidgettext').modal('hide');

            fnxText =  $('#fnxbuilderwidgettext').val().replace(/(<([^>]+)>)/gi, "").substring(0,75);;


            setWidgetPreview('<small>'+fnxText+'</small>');

            $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
            fnxBuilderSaveArea();
        });

});
</script>