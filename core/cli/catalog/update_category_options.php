<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(__DIR__))).'/index.php';
##########################################
$parent_category = 21; //категория с опция ми которые нужно скопировать




$options = $modx->getCollection('msCategoryOption', array('category_id' => $parent_category));

foreach ($options as $option){
    print($option->get('option_id'));
}