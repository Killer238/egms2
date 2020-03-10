<?php
/*
    [0] => Array
        (
            [MIGX_id] => 1
            [host] => *
            [meta_title] => детские
            [meta_keywords] => детские
            [meta_description] => детские
            [meta_h1] => детские
        )
*/
$type = $modx->getOption('type', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

$new_ceo_data = array();
//для всех страниц кроме продуктовых сео берем из global_ceo
$ceo_datas = json_decode($modx->resource->getTVValue('global_ceo'), 1);

// если товар,
if($modx->resource->class_key=="msProduct")
{

    $where = $modx->newQuery('modResource');
    $where->leftJoin('modTemplateVarResource', 'TemplateVarResources');
    $where->leftJoin('modTemplateVar', 'tv', "tv.id=TemplateVarResources.tmplvarid");
    $where->limit(5);// Лимит
    $where->where(array(
        array(
            'tv.name'   => 'catalog_map', // Имя TV привязки каталога
            'context_key' => $modx->context->key,
            'TemplateVarResources.value'    => $modx->resource->parent,// Значение TV привязанного каталога
        )
    ));
    $ceo_datas_tmp = array();
    $resources = $modx->getCollection('modResource',$where);
    if($resources) {
        foreach ($resources as $resource) {
            //die("-".$resource->get('id'));
            $ceo_datas_tmp = json_decode($resource->getTVValue('product_ceo_themplate'), 1);
            break;
        }
    }

    //если не найдено, то берем из настроек контекста
    if(!$ceo_datas_tmp)
    {
        $ceo_datas = array(
            0 => array(
                'host' => '*',
                'meta_title' => $modx->getContext($modx->context->key)->getOption('template_product_title'),
                'meta_keywords' => '',
                'meta_description' => $modx->getContext($modx->context->key)->getOption('template_product_description'),
                'meta_h1' => $modx->getContext($modx->context->key)->getOption('template_product_h1'),
            )
        );
    }else
        $ceo_datas = $ceo_datas_tmp;


}

//die(print_r($ceo_datas));
//die($host);

foreach ($ceo_datas as $ceo_data){
    $new_ceo_data[$ceo_data['host']] = $ceo_data;
}

if($new_ceo_data[$host])
    $output = $new_ceo_data[$host];
else
    $output = $new_ceo_data['*'];
//die(print_r($output));

return $output;