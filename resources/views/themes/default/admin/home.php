<?php

$this->addRepetable('gallery',__('template.gallery'),[
    'image' => __('template.image'),
    'text' => __('template.text')
],TRUE);
$this->addContent('main_title',__('template.main_title'), 'text', __('template.main_content'));
