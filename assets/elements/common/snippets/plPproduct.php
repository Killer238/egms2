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
    if($action==7)
    {
        //TODO: создать товар и загрузить данные по умолчанию
        $id_pproduct = $object->get('id');
        $manager->productCreate($id_pproduct);
    }

    $request = array(
        /*'select'=> array(
            'id_product' => 89,
        ),*/
        'load_params' => array(
            'load_meta' => false,
            'load_article' => false,
            'load_name' => false,
            'load_description' => false,
            'load_price' => true,
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

    if($action==1)
    {
        //
        //обновить цены
        //$manager->updateProductContent($object->get('id'),$request['load_params'], $request['params']);
    }

}


return $modx->toJson($result);