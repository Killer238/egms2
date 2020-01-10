<?php
$type = $modx->getOption('type', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

$new_ceo_data = array();
$ceo_datas = json_decode($modx->resource->getTVValue('catalog_ceo'), 1);
foreach ($ceo_datas as $ceo_data){
    $new_ceo_data[$ceo_data['host']] = $ceo_data;
}

if($new_ceo_data[$host])
    $output = $new_ceo_data[$host];
else
    $output = $new_ceo_data['*'];

return $output;