<?php
$widgetIcons['image'] = '<i class="las la-image"></i>';

if(!function_exists('widgetPreviewImage')){
    function widgetPreviewImage($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->image)){
            return '<small><img src="'.url($content->image).'" /></small>';
        }
        
    }
}