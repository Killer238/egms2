<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(__DIR__))).'/index.php';
require_once(MODX_CORE_PATH . 'components/ploader/model/ploader/loadmanager.php');

$select_co['option_id'] = 8;
$select_co['category_id'] = 2745;
//$select_co['rank'] = 0;
//$select_co['active'] = 1;
//$select_co['required'] = 0;
$newCat = $modx->newObject('msCategoryOption');
$newCat->fromArray($select_co);
$newCat->set('option_id', 8);
$newCat->set('category_id', 2745);
$newCat->save();