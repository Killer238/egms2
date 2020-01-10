<?php

define('MODX_API_MODE', true);

include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';


$modx->loadClass('plLoads', MODX_CORE_PATH.'components/ploader/model/ploader/');
$connectors = $modx->getCollection('plLoads');

foreach ($connectors as $connector){

    echo $connector->url;
}

echo 'ok!!!';