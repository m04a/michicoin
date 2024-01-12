
<script src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('packages/jquery-colorbox/jquery.colorbox-min.js') }}"></script>
<script type="text/javascript">

function loadWidgetFields(modalID){
    var content = $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val().trim();
    try {
        var deco = JSON.parse(content);
    } catch (error) {
        var deco = {};       
    }

    var fields = $('#'+modalID+' .widget-field').each(function(){
        var type = this.type;
        var name = this.name;
        var tag = this.tagName.toLowerCase(); // normalize case
        
        if (type == 'text' || type == 'password' || tag == 'textarea'){            
            $(this).val('');
        }
        else if (type == 'number' ){
            $(this).val('0');
        }
        else if (type == 'checkbox' || type == 'radio'){
            this.checked = false;
        }
        else if (tag == 'select'){           
           $(this).val($(this).find('option:first').val());
        }

        if(deco[name]!=undefined){
            this.value = deco[name];
        }
    });
}


function setWidgetPreview(val){
    console.log('Set preview',val);
    console.log( $('.fnxbuildercurrentwidget .preview'));
    $('.fnxbuildercurrentwidget .preview').html(val);
}

function saveWidgetFields(modalID){
    var widget_content = {};
    var fields = $('#'+modalID+' .widget-field').each(function(){
        var name = this.name;
        widget_content[name] = this.value;
    });

    $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val(JSON.stringify(widget_content));

    $('#'+modalID).modal('hide');
    $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
    fnxBuilderSaveArea();
}

function fnxBuilderInitElement(element){
       // console.log(element);
    }

    //opcions dels COntainers
    var container_options = ['pt','pb','mt','mb','bgcolor','class','image','bgtype'];


    // this global variable is used to remember what input to update with the file path
    // because elfinder is actually loaded in an iframe by colorbox
    var elfinderTarget = false;
    // function to update the file selected by elfinder
    function processSelectedFile(filePath, requestingField) {
        elfinderTarget.val(filePath.replace(/\\/g,"/"));
        elfinderTarget.parent().parent().find('.image').attr('src','{{url('')}}/'+filePath.replace(/\\/g,"/")).removeClass('d-none');;
        elfinderTarget = false;
    }

    var triggerUrl = '{{ url(config('elfinder.route.prefix').'/popup') }}';
    var element = $('#fnxbuilderwidgetimage');

  /*  element.siblings('.input-group-append').children('button.popup_selector').click(function (event) {
        event.preventDefault();
        elfinderTarget = element;
        // trigger the reveal modal with elfinder inside
        $.colorbox({
            href: triggerUrl + '/fnxbuilderwidgetimage' ,
            fastIframe: true,
            iframe: true,
            width: '80%',
            height: '80%'
        });
    });*/
    function filterWidgets(){
        var filter = $('.js-fnxbuilder-filter-widgets').val().toUpperCase();
        $('.js-fnxbuilder-pickwidget').parent().removeClass('d-none');
        
        if(filter.length > 2){
            $('.js-fnxbuilder-pickwidget').each(function(i){
                name = $(this).data('widgetname') + $(this).data('widgetdesc');

                if (name.toUpperCase().indexOf(filter) > -1) {
                    $(this).parent().removeClass('d-none');
                }
                else{
                    $(this).parent().addClass('d-none');
                }
            });
        }
    }

    $('.js-fnxbuilder-filter-widgets').change(filterWidgets);
    $('.js-fnxbuilder-filter-widgets').keyup(filterWidgets);

    $('body').on('click','.js-fnxbuilder-popup_selector',function(e){
        event.preventDefault();
        elfinderTarget = $('#'+$(this).data('target'));
        // trigger the reveal modal with elfinder inside
        $.colorbox({
            href: triggerUrl + '/' + $(this).data('target') ,
            fastIframe: true,
            iframe: true,
            width: '80%',
            height: '80%'
        });
    });

    $('body').on('click','.js-fnxbuilder-clear_elfinder_picker',function(e){
        event.preventDefault();
        element = $('#'+$(this).data('target'));
        // trigger the reveal modal with elfinder inside
        element.parent().parent().find('.image').attr('src','').addClass('d-none');
        element.val('');
    });


    $(function() {
        $( ".builder_area" ).sortable({
            handle: ".fnx-builder-move",
            stop: function( event, ui ) {
                fnxBuilderSaveArea();
            }
        });

        $( ".widgets_col_area" ).sortable({
            handle: ".fnx-builder-move-col",
            connectWith: '.widgets_col_area',
            stop: function( event, ui ) {
                fnxBuilderSaveArea();
            }
        });



    });

    function fnxBuilderEncodeItem(item){
        var dclass = '';
        var sons = [];
        var widget = '';

        if(!item.hasClass('fnxbuilder-process')){
            return '';
        }

        if(item.hasClass('fnxbuilder-content')){
            return {content: item.val()};
        }

        if(item.children()){

            item.children().each(function(i){
                child_encoded = fnxBuilderEncodeItem($(this));
                if(child_encoded!=''){
                    sons.push(child_encoded);
                }
                
            });

        }

        encoded = {};

        if( item.data('dclass') != undefined){
            encoded.dclass = item.data('dclass');
        }

        if( item.data('widget') != undefined){
            encoded.widget =  item.data('widget');;
        }

        if(sons!=[]){
            encoded.sons = sons;
        }

        $.each(container_options, function(i,v){
            if( item.data(v) != undefined){
                encoded[v] =  item.data(v);
            }
        });



        return encoded;

    }

    function fnxBuilderSaveArea(){
        $('.fnx_builder').each(function(){
            destination = $(this).find('.fnxbuilder-textarea');
            area = $(this).find('.builder_area');
            encoded = fnxBuilderEncodeItem(area);
            destination.val(JSON.stringify(encoded.sons));
        });
    }

    

    $('.js-fnxbuilder-pickwidget').click(function(e){

        e.preventDefault();
        $('#modalFnxBuilderPicker').modal('hide');
    //    $('.fnxbuildercurrentwidget').data('widget',$(this).data('widget'));
//        $('.fnxbuildercurrentwidget').empty();

       /* var colheader = '<div class="fnx-builder-col-header">';
        colheader += '<a href="#" class="js-fnx-builder-edit-col"><i class="la la-edit"></i></a>';
        colheader += '<a href="#" class="js-fnx-builder-copy-col"><i class="la la-copy"></i></a>';
        colheader += '</div>'; */  
       // $('.fnxbuildercurrentwidget .widgets_col_area').append(colheader);

        newWidget = '<div class="widget_container fnxbuilder-process" data-widget="'+$(this).data('widget')+'">'
        newWidget += '<h5 class="fnbuilder_widget_name">'+$(this).data('widgeticon')+' '+$(this).data('widgetname')+'</h5>';
        newWidget += '<div class="preview"></div>';
        newWidget += '<a href="#" class="js-fnx-builder-edit-widget fnxbuilder-action" data-widget="'+$(this).data('widget')+'"><i class="la la-edit"></i></a>'
        newWidget += '<a href="#" type="button" class="js-fnx-builder-delete-widget fnxbuilder-action"><i class="la la-trash"></i></a>'
        newWidget += '<span class="fnx-builder-move-col fnxbuilder-action"> <i class="la la-arrows"></i> </span>';
        newWidget += ' <a href="#" class="js-fnx-builder-clone-widget fnxbuilder-action"><i class="la la-copy"></i></a>';
        newWidget += '<textarea class="d-none fnxbuilder-process fnxbuilder-content">&nbsp;</textarea>';
        newWidget += '</div>'
        $('.fnxbuildercurrentwidget .widgets_col_area').append(newWidget);

        fnxBuilderSaveArea();

        $('.fnxbuildercurrentwidget .widgets_col_area .widget_container:last-child').find('.js-fnx-builder-edit-widget').trigger('click');

    });

    $('.js-fnxbuilder-savecontainer').click(function(){

        $.each(container_options, function(i,v){
            $('.fnxbuildercurrentcont').data(v,$('#fbcont-'+v).val());
        });

        $('#modalFnxContainerEdit').modal('hide');
        $('.fnxbuildercurrentcont').removeClass('fnxbuildercurrentcont');
        fnxBuilderSaveArea();
    });


    $('.js-fnxbuilder-savecolumn').click(function(){

        $.each(container_options, function(i,v){
            $('.fnxbuildercurrentwidget').data(v,$('#fbcol-'+v).val());
        });

        $('#modalFnxColEdit').modal('hide');
        $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
        fnxBuilderSaveArea();
        });

    $('.builder_area').on('click','.js-fnx-builder-delete-widget',function(){

        Swal.fire({
            title: '{{__('builder.confirm_delete_widget')}}',
            showCancelButton: true,
            icon: "question",
            confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
            confirmButtonText: "{{__('builder.confirm')}}",
            cancelButtonText:"{{__('builder.cancel')}}",
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              /*  var btn_add = '<div class="fnx-builder-col-header">';
                btn_add += '<a href="#" class="js-fnx-builder-edit-col"><i class="la la-edit"></i></a>';
                btn_add += '</div>';  
                btn_add += '<a href="#" class="js-fnx-builder-add-widget single-item fnxbuilder-action"><i class="la la-plus"></i></a>'*/
            
                $(this).parent().remove();

             //   $(this).parent().html(btn_add);

                fnxBuilderSaveArea();
            }
            })






        

    });

    $('.builder_area').on('click','.js-fnx-builder-edit-widget',function(){
       $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
       $(this).parent().addClass('fnxbuildercurrentwidget');
       var widget = $(this).data('widget');
       $('#modalFnxWidget'+widget).modal('show');
    });

    $('.builder_area').on('click','.js-fnx-builder-delete-row',function(){


        Swal.fire({
            title: '{{__('builder.confirm_delete_row')}}',
            showCancelButton: true,
            icon: "question",
            confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
            confirmButtonText: "{{__('builder.confirm')}}",
            cancelButtonText:"{{__('builder.cancel')}}",
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $(this).parent().parent().parent().remove();
                fnxBuilderSaveArea();
            }
            })



    });

    $('.builder_area').on('click','.js-fnx-builder-edit-container',function(){
        $('.fnxbuildercurrentcont').removeClass('fnxbuildercurrentcont');
        $(this).parent().parent().parent().addClass('fnxbuildercurrentcont');

        //$('.fnxbuildercurrentcont').data('options');

        $.each(container_options, function(i,v){
            if($('.fnxbuildercurrentcont').data(v)!=undefined){
                $('#fbcont-'+v).val($('.fnxbuildercurrentcont').data(v));
            }
            else{
                if(v=='bgcolor'){
                    $('#fbcont-'+v).val('#FFFFFF');
                }
                else if(v=='class'){
                    $('#fbcont-'+v).val('');
                }
                else if(v=='image'){
                    $('#fbcont-'+v).val('');
                }
                else
                {
                    $('#fbcont-'+v).val(0);
                }
            }           
        });

        $('#modalFnxContainerEdit').modal('show');
    });



    $('.builder_area').on('click','.js-fnx-builder-clone-container',function(){
        $('.widgets_col_area').sortable( "destroy" );

        $('.fnxbuildercurrentcont').removeClass('fnxbuildercurrentcont');
        $(this).parent().parent().parent().addClass('fnxbuildercurrentcont');

        $('.fnxbuildercurrentcont').clone().appendTo($('.fnxbuildercurrentcont').parent() );
        $('.fnxbuildercurrentcont').removeClass('fnxbuildercurrentcont');


        


        $( ".widgets_col_area" ).sortable({
            handle: ".fnx-builder-move-col",
            connectWith: '.widgets_col_area',
            stop: function( event, ui ) {
                fnxBuilderSaveArea();
            }
        });

        fnxBuilderSaveArea();

    });



    $('.builder_area').on('click','.js-fnx-builder-clone-widget',function(e){
        e.preventDefault();
        $(this).parent().clone().appendTo($(this).parent().parent());
 
        fnxBuilderSaveArea();

     /*   $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
        $(this).parent().parent().addClass('fnxbuildercurrentwidget');

        if($('.js-fnx-builder-add-widget').length==0){
            Swal.fire({
            title: '{{__('builder.not_empty_cols')}}',
            icon: "warning",
            confirmButtonColor: '#3085d6',
            confirmButtonText: "{{__('builder.confirm')}}"
            });
        }
        else{
            $('.js-fnx-builder-add-widget i').removeClass('la-plus').addClass('la-paste');
            $('.js-fnx-builder-add-widget').removeClass('js-fnx-builder-add-widget').addClass('js-fnx-builder-paste-col');

            setTimeout(function(){             
                $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
                $('.js-fnx-builder-paste-col').addClass('js-fnx-builder-add-widget').removeClass('js-fnx-builder-paste-col');
                $('.js-fnx-builder-add-widget i').removeClass('la-paste').addClass('la-plus');
            }, 5000);
        }
*/
    });


    $('.builder_area').on('click','.js-fnx-builder-paste-col',function(e){
        e.preventDefault();
        
        //TODO COPY VALUES?
        var parent = $(this).parent();
        parent.empty();
    

        var copyhtml = $('.fnxbuildercurrentwidget').html();
        console.log(copyhtml);
        parent.html(copyhtml);

        parent.data('widget',$('.fnxbuildercurrentwidget').data('widget'));
        parent.data('class',$('.fnxbuildercurrentwidget').data('class'));
        parent.data('bgcolor',$('.fnxbuildercurrentwidget').data('bgcolor'));
        parent.data('image',$('.fnxbuildercurrentwidget').data('image'));
        parent.data('pt',$('.fnxbuildercurrentwidget').data('pt'));
        parent.data('pb',$('.fnxbuildercurrentwidget').data('pb'));
        parent.data('mt',$('.fnxbuildercurrentwidget').data('mt'));
        parent.data('mb',$('.fnxbuildercurrentwidget').data('mb'));

        
        $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
        $('.js-fnx-builder-paste-col').addClass('js-fnx-builder-add-widget').removeClass('js-fnx-builder-paste-col');
        $('.js-fnx-builder-add-widget i').removeClass('la-paste').addClass('la-plus');

        fnxBuilderSaveArea();

    });



    $('.builder_area').on('click','.js-fnx-builder-edit-col',function(e){
        e.preventDefault();

        $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
        $(this).parent().parent().addClass('fnxbuildercurrentwidget');

       // $('.fnxbuildercurrentwidget').data('options');

        $.each(container_options, function(i,v){
            if($('.fnxbuildercurrentwidget').data(v)!=undefined){
                $('#fbcol-'+v).val($('.fnxbuildercurrentwidget').data(v));
            }
            else{
                if(v=='bgcolor'){
                    $('#fbcol-'+v).val('#FFFFFF');
                }
                else if(v=='class'){
                    $('#fbcol-'+v).val('');
                }
                else if(v=='image'){
                    $('#fbcol-'+v).val('');
                }
                else
                {
                    $('#fbcol-'+v).val(0);
                }
            }           
        });

        $('#modalFnxColEdit').modal('show');
    });

    $('.builder_area').on('click','.js-fnx-builder-add-widget',function(){
        $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
       $(this).parent().addClass('fnxbuildercurrentwidget');
       $('.js-fnxbuilder-filter-widgets').val('');
       filterWidgets();
       $('#modalFnxBuilderPicker').modal('show');
    });

    var FnxBuilderArea = '';

    $('.js-setarea').click(function(){
        FnxBuilderArea = $(this).data('area');
    });

    $('.js-fnx-builder-add-row').click(function(){
      //  builder_area = $(this).parent().parent().find('.builder_area');
        builder_area = $(FnxBuilderArea);



        options = $(this).data('options');

        container = options.container;
        if(container==undefined){
            container = 'container';
        }

        new_row = '<div class="fnxbuilder-process shadow '+container+'"  data-dclass="'+container+'">';
        new_row += '<div class="row fnx-builder-row-head">';
        new_row += '<div clasS=" col-6">';
        new_row += '<span class="fnx-builder-move"><i class="la la-arrows"></i></span>';
        new_row += '<button type="button" class="fnx-builder-btn-container js-fnx-builder-edit-container"><i class="la la-edit"></i></button>';
        new_row += '<button type="button" class="fnx-builder-btn-container js-fnx-builder-clone-container"><i class="la la-clone"></i></button>';

        new_row += '</div>';
        new_row += '<div clasS=" col-6 text-right"><button type="button" class="fnx-builder-delete-row js-fnx-builder-delete-row"><i class="la la-trash"></i></button></div>';
        new_row += '</div><div class="row fnxbuilder-process" data-dclass="'+options.row+'">';

        btn_add = ' <div class="widgets_col_area fnxbuilder-process"></div><a href="#" class="js-fnx-builder-add-widget single-item fnxbuilder-action"><i class="la la-plus"></i></a>'

        columns = options.columns;
        if(columns!=undefined){
            $.each(columns, function(i,v){
                new_row += '<div class="fnx-builder-col fnxbuilder-process '+v+'" data-dclass="'+v+'">';
                new_row += '<div class="fnx-builder-col-header">';
                new_row += '<a href="#" class="js-fnx-builder-edit-col"><i class="la la-edit"></i></a>';
                new_row += '</div>';                        
                new_row += btn_add;
                new_row += '</div>';
            });
        }
        else{
            new_row += '<div class="fnx-builder-col fnxbuilder-process col-md-12" data-dclass="col-md-12"><div>';
            new_row += btn_add;
            new_row += '</div></div>';
        }
        new_row += '</div></div>';

        $('.widgets_col_area').sortable( "destroy" );

        builder_area.append(new_row);
        
        $( ".widgets_col_area" ).sortable({
            handle: ".fnx-builder-move-col",
            connectWith: '.widgets_col_area',
            stop: function( event, ui ) {
                fnxBuilderSaveArea();
            }
        });

        fnxBuilderSaveArea();

    });
  </script>

@if(file_exists(resource_path('views/themes/'.getTheme().'/builder/scripts.blade.php'))){
@include('themes/'.getTheme().'/builder/scripts')
@endif