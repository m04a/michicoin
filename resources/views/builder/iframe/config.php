<?php
$widgetIcons['iframe'] = '<i class="las la-code"></i>';

$ratios = [
    '21by9' => __('builder.ratio_21by9'),
    '16by9' => __('builder.ratio_16by9'),
    '4by3' => __('builder.ratio_4by3'),
    '1by1' => __('builder.ratio_1by1'),
];



if(!function_exists('widgetPreviewIframe')){
    function widgetPreviewIframe($content){
        if($content!=''){
            $content = json_decode($content);
        }

        if(isset($content->iframe)){
            return '<small>'.htmlspecialchars($content->iframe).'</small>';
        }
        
    }
}
