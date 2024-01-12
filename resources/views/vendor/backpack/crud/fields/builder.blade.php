<?php 
    $builder_path = resource_path('views/builder').'/';
    include($builder_path.'config.php');
    
    
    $widgets = array_filter(glob($builder_path.'*'), 'is_dir');
    
    $theme_widgets_path =  resource_path('views/themes/'.getTheme().'/builder').'/';
    $theme_widgets = [];
    if(is_dir($theme_widgets_path)){
        $theme_widgets = array_filter(glob($theme_widgets_path.'*'), 'is_dir');
       // $widgets = array_merge($widgets,$theme_widgets);
    }

    foreach($widgets as $wdgt){
        include($wdgt.'/config.php');
    }
    

    foreach($theme_widgets as $wdgt){
        include($wdgt.'/config.php');
    }
    

    $field['attributes']['class'] = 'form-control fnxbuilder-textarea d-none';
    $textarea_content =  old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));
    $decoded_content = json_decode($textarea_content);
  
    include(themeConfigFile());


?>
<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')

<div class="fnx_builder">
<textarea 

    data-init-function="fnxBuilderInitElement"
    name="{{ $field['name'] }}"
    @include('crud::fields.inc.attributes')

    >{{$textarea_content }}</textarea>

    <div class="builder_buttons text-right">
        <button type="button" class="btn btn-primary js-setarea" data-area="#fnxba{{$field['name']}}" data-toggle="modal" data-target="#sectionsBuilderModal">
            <i class="la la-plus"></i> {{__('builder.add_section')}}
        </button>

    </div>
    <div class="builder_area fnxbuilder-process"  id="fnxba{{$field['name']}}">
        @if($textarea_content!='')

        @foreach($decoded_content as $decontainer)
        <!-- containers -->
        <div class="fnxbuilder-process shadow container" data-dclass="{{$decontainer->dclass ?? ''}}"  data-class="{{$decontainer->class ?? ''}}" data-image="{{$decontainer->image ?? ''}}"  data-pt="{{$decontainer->pt ?? 0}}" data-pb="{{$decontainer->pb ?? 0}}" data-mt="{{$decontainer->mt ?? 0}}" data-mb="{{$decontainer->mb ?? 0}}" data-bgcolor="{{$decontainer->bgcolor ?? '#FFFFFF'}}">
            @foreach($decontainer->sons as $drow)
            <!-- rows -->
            <div class="row fnx-builder-row-head">
                <div class="col-6">
                    <span class="fnx-builder-move"><i class="la la-arrows"></i></span>
                    <button type="button" class="fnx-builder-btn-container js-fnx-builder-edit-container"><i class="la la-edit"></i></button>
                    <button type="button" class="fnx-builder-btn-container js-fnx-builder-clone-container"><i class="la la-clone"></i></button>
                </div>
                <div class="col-6 text-right">                    
                    <button type="button" class="fnx-builder-delete-row js-fnx-builder-delete-row"><i class="la la-trash"></i></button>
                </div>
            </div>
            <div class="fnxbuilder-process {{$drow->dclass}}" data-dclass="{{$drow->dclass}}">
                <!-- cols -->
                @foreach($drow->sons as $dcol)
       
                <div class="fnxbuilder-process  fnx-builder-col {{$dcol->dclass}}" data-dclass="{{$dcol->dclass ?? 'col-12'}}"  data-class="{{$dcol->class ?? ''}}" data-image="{{$dcol->image ?? ''}}"  data-pt="{{$dcol->pt ?? 0}}" data-pb="{{$dcol->pb ?? 0}}" data-mt="{{$dcol->mt ?? 0}}" data-mb="{{$dcol->mb ?? 0}}" data-bgcolor="{{$dcol->bgcolor ?? '#FFFFFF'}}">
                    <div class="fnx-builder-col-header">
                        <a href="#" class="js-fnx-builder-edit-col"><i class="la la-edit"></i></a>
                        @if(isset($dcol->widget) && $dcol->widget!='')
                        <a href="#" class="js-fnx-builder-copy-col"><i class="la la-copy"></i></a>
                        @endif
                    </div>
                    <div class="widgets_col_area fnxbuilder-process">
                    @if(isset($dcol->sons) && $dcol->sons[0]  && isset($dcol->sons[0]->sons) && count($dcol->sons[0]->sons) > 0)
                    @foreach($dcol->sons[0]->sons as $wson)
                    <div class="widget_container fnxbuilder-process" data-widget="{{$wson->widget}}">
              
                    <h5 class="fnbuilder_widget_name"> {!! $widgetIcons[$wson->widget] ?? '' !!} {{__('builder.'.$wson->widget)}}</h5>
                    <div class="preview">
                        <?php 
                            $funcName = 'widgetPreview'.ucfirst($wson->widget);
                           
                            if(function_exists($funcName)){
                                echo $funcName($wson->sons[0]->content ?? '');
                            }      
                            else{
                                echo 'missing '. $funcName;
                            }
                        ?>
                    </div>
                        <a href="#" class="js-fnx-builder-edit-widget fnxbuilder-action" data-widget="{{$wson->widget}}"><i class="la la-edit"></i></a>
                        <a href="#" class="js-fnx-builder-delete-widget fnxbuilder-action"><i class="la la-trash"></i></a>
                        <span class="fnx-builder-move-col fnxbuilder-action">
                            <i class="la la-arrows"></i>
                        </span>
                        <a href="#" class="js-fnx-builder-clone-widget fnxbuilder-action"><i class="la la-copy"></i></a>

                        <textarea class="d-none fnxbuilder-process fnxbuilder-content">{{$wson->sons[0]->content ?? ''}}</textarea>
                    </div>
                    @endforeach
                    @endif

                    
                    @if(isset($dcol->widget) && $dcol->widget!='')
                    <h5 class="fnbuilder_widget_name">{{__('builder.'.$dcol->widget)}}</h5>
                    <a href="#" class="js-fnx-builder-edit-widget fnxbuilder-action" data-widget="{{$dcol->widget}}"><i class="la la-edit"></i></a>
                    <a href="#" class="js-fnx-builder-delete-widget fnxbuilder-action"><i class="la la-trash"></i></a>
                    @endif


                    </div>

                   <a href="#" class="js-fnx-builder-add-widget single-item fnxbuilder-action"><i class="la la-plus"></i></a>
               
                </div>
                @endforeach
                <!-- end cols -->
            </div>
            <!-- end rows -->
            @endforeach
        </div>
        <!-- end containers -->
        @endforeach
    @endif
    </div>

   
</div>
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}
    @push('crud_fields_styles')
    @include('builder.styles')       

       
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
    

    @include('builder.modal_picker')       
    @include('builder.modal_widgets')       
    @include('builder.modal_editcontainer')    
    @include('builder.modal_editcolumn')       
   
    @include('builder.modal_sections')       

    @include('builder.scripts')       

    
    @endpush
@endif



