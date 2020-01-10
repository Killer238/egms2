<?php

define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';


$data = array(           'class_key' => 'msProduct',
            'pagetitle' => 'Товар 2',
            'parent' => 21,
            'template' => 1,
            'show_in_tree' => 0,

            'price' => 100);

$response = $modx->runProcessor('resource/create', $data);

print_r($response);
//if ($response->isError()) {
//	$modx->log(modX::LOG_LEVEL_ERROR, "Error on create: \n". print_r($response->getAllErrors(), 1));
//}

$modification =
    array(
        array(
            'name' => 'Размер',
            'price' => 500,
            'old_price' => 1000,
            'options' => array(
                'color' =>  'red',
                'size' => '50x700'
            )
        )
    );

$modification =
    array(
        array(
            'name' => 'z111',
            'price' => 500,
            'old_price' => 1000,
            'article' => '',
            'weight' => '',
            'count' => 0,
            'options' => array(
                'size' => '50x700'
            )
        )
    );

$m1 =
    array(
        array(
            'name' => 'z111',
        )
    );
$m1 =
    array(
        array(
            'options' => array(
                'size' => '50x700'
            )
        )
    );
$m1 =
    array(
        array()
    );

//$modification = $modx->call('msopModification', 'saveProductModification', array(&$modx, 36, $modification));
//$modification = $modx->call('msopModification', 'removeProductModification', array(&$modx, 36, $m1));