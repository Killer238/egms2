<?php
$request = array(
    'select' => array(
        'provider' => 'wwwmatrasru',
        //'page_type' => 'NEW',
        //'id_category' => 3,
        //'id_manufacturer' => 3,
        'id' => 26952
    ),
    'params' => array(
        'image_cache' => true,
        'proxy' => null,
    )
);

//###########################################################################################################
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
//#########################################################################################################
$manager = new loadmanager($modx);
$loads = $modx->getCollection('plLoads', $request['select']);

foreach ($loads as $load)
{
    $manager->createCache($load->get('id'), $request['params']);
    print "Cache Created id_load: ".$load->get('id')."; product: ".$load->get('url_product_name'). "\n";
    $manager->printErrors();
}

print_r($manager->result);
