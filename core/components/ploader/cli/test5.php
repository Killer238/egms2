<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$filter = "";

$arr = explode("\r\n", $filter);
array_unshift($arr, "11111");

print_r($arr);