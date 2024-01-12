<?php
$widgetIcons['text'] = '<i class="las la-align-justify"></i>';


if(!function_exists('widgetPreviewText')){
    function widgetPreviewText($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->text)){
            return '<small>'.Str::limit(strip_tags($content->text),75).'</small>';
        }
        
    }
}
