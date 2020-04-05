<?php
$filter = $modx->getOption('filter', $scriptProperties);

$catalog_full = $modx->getContext($modx->context->key)->getOption('catalog_full');
if($catalog_full!=1){
    $filter_result['innerJoin']='{"msProductData":{"alias":"product","on":"product.id=modResource.id"}}';
    $filter_result['where']='[[{"product.vendor:IN":'. $modx->getPlaceholder('region.vendors_arr') .'}]]';
}

foreach ($filter as $k => $v)
{
    $filter_result[$k] = $v;
}
//die(print_r($filter_result));
return $filter_result;