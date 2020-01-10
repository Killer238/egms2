<?php
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


$object = & $modx->getOption('object',$scriptProperties,null);//reference to the saved object
$properties = $modx->getOption('scriptProperties',$scriptProperties,array());//the processors scriptProperties

$result = array();
if ($object){

    $request = array(
        'select' => array(
            //'provider' => 'wwwmatrasru',
            //'id' => 45
        ),
        'params' => array(
            'proxy' => false,
            'cache' => false,
            'exist_url' => true,
        )
    );
    $action = $object->get('action');
    if($action==1)
    {
        $manager = new loadmanager($modx);
        $manager->loadConnectors($object->get('provider'), $object->get('id'), $request['params']);
    }
}


return $modx->toJson($result);