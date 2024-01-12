<div id="fnxbuildertabsoriginal" class="d-none">
    <div class="tab mb-4 rowitem"  id="fnxbuilderwidgettabs">

        <div class="fnxbuilder-bg-tools row mb-3">
            <div class="col-6">
            <span class="fnxbuilder-tool move"><i class="la la-arrows"></i></span>
            </div>
            <div class="col-6  text-right">
                <a href="#" class="fnxbuilder-tool js-fnxbuildertabs-remove" ><i class="la la-times"></i> </a>                    
            </div>
        </div>
        <div>

            <div class="form-group">
                <input type="text"   data-name="title" placeholder="{{__('builder.title')}}" name="title" class="form-control field-input  field-input-title">
            </div>
                
                
            <div class="form-group">
                <textarea  name="fnxbtabseditor" data-name="content"  placeholder="{{__('builder.content')}}" class="form-control field-input field-input-content" ></textarea>
            </div>
           
        </div>


    </div>


</div>


<div class="row" id="fnxbuildertabsoptions">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label for="">{{__('builder.accordion_or_tabs')}}</label>
            <select name="mode" class="form-control field-option field-option-mode">
                <option value="accordion">{{__('builder.accordion')}}</option>
                <option value="tabs">{{__('builder.tabs')}}</option>
            </select>
        </div>        
    </div>

  
</div>

<div id="fnxbuildertabsholder">


    
</div>

<div class="text-center mt-3">
    <a class="fnxbuilder-action js-fnxbuildertabs-add" href="#">
        <i class="la la-plus "></i>
    </a>
</div>


<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

<script>
$(function(){

        function destroyEditor(){
            for(name in CKEDITOR.instances)
            {
                CKEDITOR.instances[name].destroy(true);
            }
        }

        function initEditor(id){
            console.log(id);
            window.setTimeout(() => {                
                CKEDITOR.replace( id );
            }, 500);
        
        }

    $( "#fnxbuildertabsholder" ).sortable({
        handle: ".move"
    });

    $('#modalFnxWidgettabs').on('click','.js-fnxbuildertabs-remove',function(e){
        e.preventDefault();
        $(this).parent().parent().parent().remove();
    });

    $('.js-fnxbuildertabs-add').click(function(){
        new_item = $('#fnxbuildertabsoriginal').html();
        new_id = 'fnxbuilderwidgettabs' + $('#fnxbuildertabsholder .tab').length;
        new_item = new_item.replace(/fnxbuilderwidgettabs/g,new_id);

        new_editor_id = 'fnxbtabseditor' + $('#fnxbuildertabsholder .tab').length;
        new_item = new_item.replace(/fnxbtabseditor/g,new_editor_id);


        initEditor(new_editor_id);

        $('#fnxbuildertabsholder').append(new_item);
        
    });



        

    $('#modalFnxWidgettabs').on('show.bs.modal', function () {
        var content = $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val().trim();
        $('#fnxbuildertabsholder').empty();
        try {
            var decoded_content = JSON.parse(content);
            $.each(decoded_content.options,function(i,v){   
                $('#fnxbuildertabsoptions').find('.field-option-'+i).val(v);
            });    
            destroyEditor();

            $.each(decoded_content.items,function(i,v){                
                new_item = $('#fnxbuildertabsoriginal').html();
                new_id = 'fnxbuilderwidgettabs' + i;
                new_item = new_item.replace(/fnxbuilderwidgettabs/g,new_id);      
                
              
                
                new_editor_id = 'fnxbtabseditor' + i;
                new_item = new_item.replace(/fnxbtabseditor/g,new_editor_id);


                
                initEditor(new_editor_id);



                $('#fnxbuildertabsholder').append(new_item);

                $.each(v,function(k,f){
                    $('#'+new_id).find('.field-input-'+k).val(f);
                });

                img_url = '{{url('')}}/'+v.image;
                $('#'+new_id).parent().parent().find('.image').removeClass('d-none').attr('src',img_url);

            });
        } catch (error) {
            CKEDITOR.instances.fnxbuilderwidgettext.setData('');
        }
    });


    $('#modalFnxWidgettabs .js-fnxbuilder-savewidget').click(function(){
            var widget_content = {};
            $('#fnxbuildertabsholder .rowitem').each(function(i){
                current ={};
                $(this).find('.field-input').each(function(){
                    current[$(this).data('name')] = $(this).val();
                });
                console.log(current);
                widget_content[i] = current;
            });

            var widget = {};
            widget['items'] = widget_content;
            widget['options'] = {};


            $('#fnxbuildertabsoptions .field-option').each(function(i){
                widget['options'][$(this).attr('name')] = $(this).val();
            });      
            
            
            $('.fnxbuildercurrentwidget').find('.fnxbuilder-content').val(JSON.stringify(widget));

            $('#modalFnxWidgettabs').modal('hide');
            $('.fnxbuildercurrentwidget').removeClass('fnxbuildercurrentwidget');
            fnxBuilderSaveArea();
        });

});
</script>