<?php
$type = $modx->getOption('type', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

$new_ceo_data = array();
$ceo_datas = json_decode($modx->resource->getTVValue('global_ceo'), 1);
// если товар, то ищи сео шаблон
if($modx->resource->class_key=="msProduct")
{
    $base_parent = $modx->getObject('modResource', $modx->resource->parent);
    $alias = $base_parent->get('alias');
    $parent = $modx->getObject('modResource', array(
        'alias' => $alias,
        'context_key' => $modx->context->key,
    ));
    $_GET['parent_bread'] = $parent->get('id');
    $ceo_datas = json_decode($parent->getTVValue('product_ceo_themplate'), 1);;
}
//die(print_r($ceo_datas));

foreach ($ceo_datas as $ceo_data){
    $new_ceo_data[$ceo_data['host']] = $ceo_data;
}

if($new_ceo_data[$host])
    $output = $new_ceo_data[$host];
else
    $output = $new_ceo_data['*'];

return $output;