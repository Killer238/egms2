<?php

$request = array(
  'select' => array(
      //'provider' => 'getmatrasru',
      'id' => 4
  ),
  'params' => array(
      'proxy' => false,
      'cache' => false,
      'exist_url' => true,
  )
);
//#############################################################################
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';
require_once(MODX_CORE_PATH . 'components/ploader/model/ploader/loadmanager.php');

$modx->loadClass('plConnectors', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plLoads', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproduct', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductReviews', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductFeature', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductFeatureMap', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductConsists', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductConsistsItem', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plCategory', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plCategoryMap', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plManufacturer', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plManufacturerMap', MODX_CORE_PATH.'components/ploader/model/ploader/');

//###############################################################################

$manager = new loadmanager($modx);
$connectors = $modx->getCollection('plConnectors', $request['select']);

foreach ($connectors as $connector) {
    $manager->loadConnectors($connector->get('provider'), $connector->get('id'), $request['params']);
    print 'connector '.$connector->get('id'). '; found: '. $manager->result['founded']. '; exist: '. $manager->result['exists'].'; added: '. $manager->result['added']."\n";
    //$manager->printErrors();
    print_r($manager->result);
}


