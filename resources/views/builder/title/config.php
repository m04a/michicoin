<?php
$titleClasses = [
    'title' => __('builder.title_normal'),
    'title title-sm' => __('builder.title_sm'),
    'title-prod' => __('builder.title_prod'),
];

$widgetIcons['title'] = '<i class="las la-heading"></i>';

if(!function_exists('widgetPreviewTitle')){
    function widgetPreviewTitle($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->title)){
            return '<small>'.$content->title.'</small>';
        }
        
    }
}
