<?php

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

switch (true) {
    case empty($_REQUEST['action']):
    case empty($_SERVER['HTTP_X_REQUESTED_WITH']):
    case $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest':
        die('Access denied');
}

define('MODX_API_MODE', true);

$productionIndex = dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';
$developmentIndex = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';
if (file_exists($productionIndex)) {
    /** @noinspection PhpIncludeInspection */
    require_once $productionIndex;
} else {
    /** @noinspection PhpIncludeInspection */
    require_once $developmentIndex;
}
$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

$corePath = $modx->getOption('cityselect_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/cityselect/');

/** @var citySelect $citySelect */
$citySelect = $modx->getService('cityselect', 'citySelect', $corePath . 'model/cityselect/',
    array('core_path' => $corePath));

$ctx = $modx->getOption('ctx', $_REQUEST, 'web', true);
$citySelect->initialize($ctx);
$response = $citySelect->runProcessor($_REQUEST['action'], $_REQUEST);
if (is_array($response)) {
    $response = json_encode($response, true);
}

@session_write_close();
echo $response;