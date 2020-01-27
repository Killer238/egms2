<?php
$modx->loadClass('egmsDelivery', MODX_CORE_PATH.'components/egms/model/egms/');

$tpl = $modx->getOption('tpl', $scriptProperties, '@FILE elements/common/chunks/product_delivery.tpl');
$id_product = $modx->getOption('id_product', $scriptProperties);

$delivery = $modx->getPlaceholder('delivery');


$delivery_arr['cost'] = 300;
$delivery_arr['freecost'] = 5000;

$pdoTools = $modx->getService('pdoTools');
return $pdoTools->getChunk($tpl, array(
    'delivery' => $delivery_arr,
));