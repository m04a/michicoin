<?php
$widgetIcons['gallery'] = '<i class="las la-images"></i>';


if(!function_exists('widgetPreviewGallery')){
    function widgetPreviewGallery($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->items) ){
            $widgetPreview = '<small>';
            foreach($content->items as $cit){
                $widgetPreview .= '<img src="'.url($cit->image).'" />';
            }
            $widgetPreview .= '</small>';
           return $widgetPreview;
        }
        else{
            return '<small>'.__('builder.gallery_empty').'</small>';
        }
        
    }
}
