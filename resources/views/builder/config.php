<?php


$rows = [
    __('builder.boxed') =>[
        __('builder.full')=>[
            'container' => 'container',
            'columns' => ['col-12']
        ],
        __('builder.two')=>[
            'container' => 'container',
            'columns' => ['col-12 col-md-6','col-12 col-md-6']
        ],
        __('builder.three')=>[
            'container' => 'container',
            'columns' => ['col-12 col-md-4','col-12 col-md-4','col-12 col-md-4']
        ],
        __('builder.two_third')=>[
            'container' => 'container',
            'columns' => ['col-12 col-md-4','col-12 col-md-8']
        ],
        __('builder.two_third_rev')=>[
            'container' => 'container',
            'columns' => ['col-12 col-md-8','col-12 col-md-4']
        ],
    ],
    __('builder.wide') =>[
        __('builder.full')=>[
            'container' => 'container-fluid',
            'columns' => ['col-12']
        ],
        __('builder.two')=>[
            'container' => 'container-fluid',
            'columns' => ['col-12 col-md-6','col-12 col-md-6']
        ],
        __('builder.three')=>[
            'container' => 'container-fluid',
            'columns' => ['col-12 col-md-4','col-12 col-md-4','col-12 col-md-4']
        ],
    ]
];



$builder_config =  resource_path('views/themes/'.getTheme().'/builder/config.php');

if(file_exists($builder_config)){
    include($builder_config);
}