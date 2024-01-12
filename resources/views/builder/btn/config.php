<?php
$widgetIcons['btn'] = '<i class="las la-plus-square"></i>';

$btnClasses=[
    'btn-white' => __('builder.btn_white'),
    'btn-success' => __('builder.btn_success'),
    'btn-danger' => __('builder.btn_danger'),
    'btn-primary' => __('builder.btn_primary'),
    'btn-default' => __('builder.btn_default'),
];



if(!function_exists('widgetPreviewBtn')){
    function widgetPreviewBtn($content){
        if($content!=''){
            $content = json_decode($content);
        }

        $widgetPreview = '<small>';
     
        if(isset($content->title)){
            $widgetPreview .= $content->title;
        }

        if(isset($content->link)){
            $widgetPreview .= ' ('.$content->link.')';
        }
        
        $widgetPreview .= '</small>';

        return $widgetPreview;

    }
}
