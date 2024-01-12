<?php
$widgetIcons['spacer'] = '<i class="las la-arrows-alt-v"></i>';



if(!function_exists('widgetPreviewSpacer')){
    function widgetPreviewSpacer($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->space_xs)){
            return '<small>'.$content->space_xs.'/'.$content->space_md.'/'.$content->space_lg.'px</small>';
        }
        
    }
}
