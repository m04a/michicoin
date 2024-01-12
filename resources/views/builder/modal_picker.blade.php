<div class="modal modal-builder fade" id="modalFnxBuilderPicker" tabindex="-1" role="dialog" aria-labelledby="modalFnxBuilderPickerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalFnxBuilderPickerLabel">{{__('builder.pick_widget')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="la la-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" class="form-control js-fnxbuilder-filter-widgets shadow" placeholder="{{__('builder.filter_widgets')}}">
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($widgets as $widgetpath)
                @php
                    $widget = str_replace($builder_path,'',$widgetpath);
                    $widget_name = __('builder.'.$widget);
                    $widget_desc = __('builder.'.$widget.'_desc');
                   
                @endphp
                <div class="col-12 col-md-6 col-lg-4 text-center mb-3 " >
                    <a href="{{$widget}}" role="button" class="js-fnxbuilder-pickwidget fnxbuilder-pickwidget "  data-widget="{{$widget}}" data-widgetname="{{$widget_name}}" data-widgeticon="{{$widgetIcons[$widget]}}" data-widgetdesc="{{$widget_desc}}">
                        <div>
                           
                            <div class="fnxbuilder-widget-title">
                                {!! $widgetIcons[$widget] ?? '' !!} {{__('builder.'.$widget)}}
                            </div>
                            <div class="fnxbuilder-widget-desc"> {{__('builder.'.$widget.'_desc')}} </div>
                        </div>                    
                    </a>               
                </div>            
                @endforeach

                @foreach($theme_widgets as $widgetpath)
                @php
                    $widget = str_replace($theme_widgets_path,'',$widgetpath);

                    $widget_name = __('builder.'.$widget);
                    $widget_desc = __('builder.'.$widget.'_desc');
                    //$picker_view = 'themes.'.getTheme().'.builder.'.$widget.'.pick';

                @endphp
                <div class="col-12 col-md-6 col-lg-4 text-center mb-3 " >
                    <a href="{{$widget}}" role="button" class="js-fnxbuilder-pickwidget fnxbuilder-pickwidget "  data-widget="{{$widget}}"  data-widgeticon="{{$widgetIcons[$widget]}}" data-widgetname="{{$widget_name}}"  data-widgetdesc="{{$widget_desc}}">
                        <div>
                        <div class="fnxbuilder-widget-title">
                                {!! $widgetIcons[$widget] ?? '' !!} {{__('builder.'.$widget)}}
                            </div>
                            <div class="fnxbuilder-widget-desc"> {{__('builder.'.$widget.'_desc')}} </div>
                        </div>                    
                    </a>               
                </div>            
                @endforeach

               
            </div>
        </div>

        </div>
    </div>
</div>