<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$product = 1777;
$t = $modx->getObject("msProduct", $product);

$n = $t->get('vendor.name');
$p = $t->get('vendor.id');
$t =1;