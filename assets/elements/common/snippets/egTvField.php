<?php
$modx->loadClass('plPproductConsistsItem', MODX_CORE_PATH.'components/ploader/model/ploader/');

$id_val = $modx->getOption('id_val', $scriptProperties);
$object = $modx->getOption('object', $scriptProperties);
$fild = $modx->getOption('field', $scriptProperties);

$o = $modx->getObject($object, $id_val);

return $o->get($field);
/*
@EVAL
$output = $modx->runSnippet('getImageList', array(

    )
);
return ' - выбор '. $output;

*/