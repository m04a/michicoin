@php

    $css = file_get_contents($field['css']);
    preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
    $result = array();
    foreach ($arr[0] as $i => $x){
        $selector = trim($arr[1][$i]);
        $selectors = explode(',', trim($selector));
        foreach ($selectors as $strSel){
            $result[] = $strSel;
        }
    }

    $matched = [];

    foreach($result as $classLine){

        if (strpos($classLine, $field['find_class']) === 0) {
            $classLineParts = explode(':',$classLine);
            $matched[] = str_replace('.','',$classLineParts[0]);
        }
    }

@endphp

@include('crud::fields.inc.wrapper_start')
<div><label>{!! $field['label'] !!}</label></div>

<div>
    <div class="row">
        @foreach($matched as $match)
        <div class="col-6 col-md-3 col-lg-2 ">
            <i class="fa-2x {{$field['show_class'].$match}} mr-3"></i> {{$match}}
        </div>
       
        @endforeach
    </div>
   
</div>

@include('crud::fields.inc.wrapper_end')


@if ($crud->fieldTypeNotLoaded($field))
@php
    $crud->markFieldTypeAsLoaded($field);
@endphp

    @push('crud_fields_styles')
        <link rel="stylesheet" type="text/css" href="{{ url($field['css']) }}">
    @endpush

@endif