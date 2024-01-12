<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    <small>
    <a href="{{  $field['value'] ?? ''  }}" target="_blank"> {{  $field['value'] ?? ''  }}</a>  
    </small>
    
@include('crud::fields.inc.wrapper_end')

