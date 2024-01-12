@foreach($widgets as $widgetpath)
@php
$admin_view = 'builder.'.str_replace($builder_path,'',$widgetpath).'.admin';
$widget = str_replace($builder_path,'',$widgetpath);
$widget_name = __('builder.'.str_replace($builder_path,'',$widgetpath));

@endphp
<div class="modal modal-builder  fade" id="modalFnxWidget{{$widget}}" data-focus="false" tabindex="-1" role="dialog" aria-labelledby="modalFnxWidget{{$widget}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalFnxWidget{{$widget}}Label">{{$widget_name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="la la-times"></i>
            </button>
        </div>
        <div class="modal-body">
            @include($admin_view) 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success js-fnxbuilder-savewidget" > <i class="la la-save"></i> {{__('builder.save')}}</button>

        </div>
        </div>
    </div>
</div>
@endforeach


@foreach($theme_widgets as $widgetpath)
@php
$widget = str_replace($theme_widgets_path,'',$widgetpath);
$widget_name = __('builder.'.$widget);
$widget_desc = __('builder.'.$widget.'_desc');
$admin_view = 'themes.'.getTheme().'.builder.'.$widget.'.admin';
@endphp
<div class="modal modal-builder  fade" id="modalFnxWidget{{$widget}}" data-focus="false" tabindex="-1" role="dialog" aria-labelledby="modalFnxWidget{{$widget}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalFnxWidget{{$widget}}Label">{{$widget_name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="la la-times"></i>
            </button>
        </div>
        <div class="modal-body">            
            @include($admin_view) 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success js-fnxbuilder-savewidget" > <i class="la la-save"></i> {{__('builder.save')}}</button>

        </div>
        </div>
    </div>
</div>
@endforeach