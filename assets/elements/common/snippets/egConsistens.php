<?php
//$modx->loadClass('plCategoryMap', MODX_CORE_PATH.'components/ploader/model/ploader/');

$tpl = $modx->getOption('tpl', $scriptProperties, 'elements/common/chunks/product_consists.tpl');

$const = json_decode($modx->resource->getTVValue('product_consists '), 1);

//TODO: запрос к БД
// для вывода доп данных

$pdoTools = $modx->getService('pdoTools');

return $pdoTools->getChunk($tpl, array(
    'consists' => $const,
));