<?php
$filter = $modx->getOption('filter', $scriptProperties);

$vh = $modx->runSnippet('egVendorsHost',['where' => 'Data.vendor:IN']);

//$_GET['vendor']=$_REQUEST['vendor']=1;
//die();
//значения фильтра по умолчанию
$filter_result = array(
'element' => 'msProducts',
    'class' => 'msProduct',
    'ajaxMode' => 'default',
    'pageLinkScheme' => '[[+pageVarKey]]-[[+page]]/',
    'showLog' => '0',
    //'cache_key' => 'dsfsd',
    'where' => $vh
);
//TODO: проверить работу из ТВ
$filter_result['filters'] = $modx->resource->getTVValue('catalog_filters');
$filter_result['aliases'] = $modx->resource->getTVValue('catalog_aliases');

if($modx->resource->getTVValue('catalog_order'))
    $filter_result['sort'] = $modx->resource->getTVValue('catalog_order');
else
    $filter_result['sort'] = 'ms|price:asc';

if($modx->resource->getTVValue('catalog_map'))
    $filter_result['parents'] = $modx->resource->getTVValue('catalog_map');

if($modx->resource->getTVValue('catalog_depth'))
    $filter_result['depth'] = $modx->resource->getTVValue('catalog_depth');
else
    $filter_result['depth'] = 0;

if ($modx->resource->getTVValue('catalog_limit'))
    $filter_result['limit'] = $modx->resource->getTVValue('catalog_limit');
else
    $filter_result['limit'] = 12;

// ОБъединение значений
foreach ($filter as $k => $v)
{
    $filter_result[$k] = $v;
}
//die(print_r($filter_result));
return $filter_result;