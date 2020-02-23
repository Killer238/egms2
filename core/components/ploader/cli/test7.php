<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$res = $modx->runSnippet('egAdminMigxWhere');

print $res;