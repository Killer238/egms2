<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(dirname(__DIR__))))).'/index.php';

$pproducts = $modx->getCollection('plPproduct');
foreach ($pproducts as $pproduct) {

    print($pproduct->get('id'));

}
