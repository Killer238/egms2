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
    $manager = new loadmanager($modx);
    $action = $object->get('action');
    if($action==1)
    {
        $request = array(
            'select' => array(
                //'provider' => 'wwwmatrasru',
                //'page_type' => 'NEW',
                //'id_category' => 3,
                //'id_manufacturer' => 3,
                //'id_load' => 30479
            ),
            'params' => array(
                'image_cache' => true,
                'proxy' => null,
            )
        );

        $manager->createCache($object->get('id'), $request['params']);
    }

    if($action==2)
    {
        $manager->pProductCreate($object->get('id'));
    }
}


return $modx->toJson($result);