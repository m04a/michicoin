<?php 
    $params = '?';
    foreach(\Request::except('page') as $k=>$v){
        if(!is_array($v)){
            $params .= "$k=$v&";
        }
        else{
            //no m'acuerdo pero
        }
    }
 ?>
<a href="{{ url($crud->route.'/export/csv').$params }}" class="btn btn-sm btn-primary">
<span class="ladda-label"><i class="la la-download"></i> {{__('template.export')}} CSV</span>
</a>