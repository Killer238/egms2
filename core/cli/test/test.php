<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(__DIR__))).'/index.php';
require_once(MODX_CORE_PATH . 'components/ploader/model/ploader/loadmanager.php');
$modx->loadClass('egmsDeliveryOptions', MODX_CORE_PATH.'components/egms/model/egms/');

$key = "key";
$doptions_t = "1||3";
$doptions = $modx->getCollection("egmsDeliveryOptions", array('id:IN' => explode('||', $doptions_t)));
foreach ($doptions as $option){
    $id_option = $option->get("id");
    $hostdata['delivery'][$key][$id_option]['id'] = $id_option;
    $hostdata['delivery'][$key][$id_option]['oname'] = $option->get("oname");
    $hostdata['delivery'][$key][$id_option]['option'] = $option->get("option");
    $hostdata['delivery'][$key][$id_option]['val'] = $option->get("val");
    $hostdata['delivery'][$key][$id_option]['params'] = $option->get("params");
    $hostdata['delivery'][$key][$id_option]['content'] = $option->get("content");
}

print_r($hostdata);