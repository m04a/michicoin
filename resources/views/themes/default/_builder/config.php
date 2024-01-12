<?php


$rows = [
    __('builder.wide') =>[
        __('builder.full')=>[
            'container' => 'container-fluid p-0',
            'columns' => ['col-12']
        ],
        __('builder.two')=>[
            'container' => 'container-fluid',
            'columns' => ['col-12 col-md-6','col-12 col-md-6']
        ],
        __('builder.four')=>[
            'container' => 'container-fluid',
            'columns' => ['col-12 col-md-6 col-lg-3','col-12 col-md-6 col-lg-3','col-12 col-md-6 col-lg-3','col-12 col-md-6 col-lg-3']
        ],
    ]
];




$icon_source = 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css';
$icon_find = '.bi-';

$css = file_get_contents($icon_source);
preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
$result = array();
foreach ($arr[0] as $i => $x){
    $selector = trim($arr[1][$i]);
    $selectors = explode(',', trim($selector));
    foreach ($selectors as $strSel){
        $result[] = $strSel;
    }
}

$icon_options = [];

foreach($result as $classLine){

    if (strpos($classLine, $icon_find) === 0) {
        $classLineParts = explode(':',$classLine);
        $icon_options[] = str_replace('.','',$classLineParts[0]);
    }
}
