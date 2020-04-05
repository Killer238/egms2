<?php
$modx->loadClass('plPproductConsists', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductConsistsItem', MODX_CORE_PATH.'components/ploader/model/ploader/');

$tpl = $modx->getOption('tpl', $scriptProperties, 'elements/common/chunks/product_consists.tpl');


$query = $modx->newQuery('plPproductConsists');
$query->innerJoin('plPproductConsistsItem','ci', 'ci.id = plPproductConsists.id_consists_item');
//$query->select($modx->getSelectColumns('plPproductConsists'));
$query->select(array(
    'plPproductConsists.id', 'ci.name','ci.description','ci.image_url'
));
$query->where(array(
    'resource_id' => $modx->resource->id,
));

$cis = $modx->getCollection('plPproductConsists',$query);
//die("-".print_r($cis));
//return $cis;
$ci_arr = array();
foreach ($cis as $ci)
{
    //die(print_r($ci->get('name')));
    $ci_arr[] = array(
        'name' => $ci->get('name'),
        'description' => $ci->get('description'),
        'image_url' => $ci->get('image_url'),
    );
}

//return $ci_arr;

//$const = json_decode($modx->resource->getTVValue('product_consists '), 1);
$pdoTools = $modx->getService('pdoTools');

return $pdoTools->getChunk($tpl, array(
    'consists' => $ci_arr,
));