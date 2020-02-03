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
    'suggestions' => false,
    //'showLog' => '1',
    //'cache_key' => 'dsfsd',
    'where' => $vh
);
//TODO: проверить работу из ТВ

if($modx->resource->getTVValue('catalog_filter'))
{
    $params = explode('&', $modx->resource->getTVValue('catalog_filter'));
    foreach ($params as $param){
        $kv = explode('=',$param);
        $_GET[$kv[0]] = $_REQUEST[$kv[0]] = $kv[1];
    }
}

$filter_result['filters'] = $modx->resource->getTVValue('catalog_filters');
if($filter_result['filters']=='')
    $filter_result['filters'] = $modx->getContext($modx->context->key)->getOption('catalog_filters');

$filter_result['aliases'] = $modx->resource->getTVValue('catalog_aliases');
if($filter_result['aliases']=='')
    $filter_result['aliases'] = $modx->getContext($modx->context->key)->getOption('catalog_aliases');

//die($filter_result['aliases']);

if($modx->resource->getTVValue('catalog_order'))
    $filter_result['sort'] = $modx->resource->getTVValue('catalog_order');
else
    $filter_result['sort'] = 'ms|price:asc';

if($modx->resource->getTVValue('catalog_map'))
    $filter_result['parents'] = $modx->resource->getTVValue('catalog_map');
else
    $filter_result['parents'] = $modx->resource->getTVValue('catalog_products');

if($modx->resource->getTVValue('catalog_depth'))
    $filter_result['depth'] = $modx->resource->getTVValue('catalog_depth');

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