<?php
$widgetIcons['form'] = '<i class="las la-clipboard-list"></i>';


$forms=[
    'form1' => __('builder.form1'),
    'form2' => __('builder.form2'),
];


if(!function_exists('widgetPreviewForm')){
    function widgetPreviewForm($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->form)){
            return '<small>'.$content->form.'</small>';
        }
        
    }
}
