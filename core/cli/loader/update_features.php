<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(__DIR__))).'/index.php';
require_once(MODX_CORE_PATH . 'components/ploader/model/ploader/loadmanager.php');
##########################################
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


$request = array(
    'select'=> array(
        //'id_category' => 2745, //2745 - premium
        //'id_product' => 315,
        'id_manufacturer' => 7
////////////////////////////////////////
        //1 - орматек,
        //2 - райтон,
        //12 - Dreamline
        //23 - Dimax,
        //41 - Agreen,
        //24 - Promtex-Orient,
        //26 - Sontelle,
        //30 - Everest
        //18 - Lonax
        //10 - verda
        //9 - sealy
        //7 - tempur
    ),
    'load_params' => array(
        'load_meta' => false,
        'load_article' => false,
        'load_name' => false,
        'load_description' => false,
        'load_price' => false,
        'load_images' => false,
        'load_features' => true,
        'load_consistions' => false,
        'load_reviews' => false,
    ),
    'params' => array(
        'proxy' => null,
        'cache' => true,
        'image_cache' => true
    ),
);

//###################################################

$manager = new loadmanager($modx);

$pproducts = $modx->getCollection('plPproduct', $request['select']);
//print(count($pproducts));
foreach ($pproducts as $pproduct)
{
    //print ($pproduct->get('id')."\n");
    $manager->updateProductContent($pproduct->get('id'),$request['load_params'], $request['params']);
    //print "Updated Prod: ".$pproduct->get('id_product')."\n";
    //$manager->printErrors();
}
