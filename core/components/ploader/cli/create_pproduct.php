<?php
$request = array(
    'select' => array(
        //'provider' => 'wwwmatrasru',
        'id' => 26954,
        //'page_type' => 'PRODUCT',
       // 'id_pproduct' => 0,
       // 'id_category:>' => 0,
//        'id_manufacturer:>' => 0,
//        'id_theme:>' => 0,
//       'published' => 1
    )
);

define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';
require_once(MODX_CORE_PATH . 'components/ploader/model/ploader/loadmanager.php');

$modx->loadClass('plConnectors', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plLoads', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproduct', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductTheme', MODX_CORE_PATH.'components/ploader/model/ploader/');

$modx->loadClass('plPproductReviews', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductFeature', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductFeatureMap', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductConsists', MODX_CORE_PATH.'components/ploader/model/ploader/');
$modx->loadClass('plPproductConsistsItem', MODX_CORE_PATH.'components/ploader/model/ploader/');

//####################################################

$manager = new loadmanager($modx);

$loads = $modx->getCollection('plLoads', $request['select']);
foreach ($loads as $load)
{
    $new_p = $manager->pProductCreate($load->get('id'));
    print "Create pproduct for id_load: ".$load->get('id')."; product: ".$new_p."\n";
    $manager->printErrors();
}
