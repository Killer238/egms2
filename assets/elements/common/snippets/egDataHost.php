<?php
$modx->loadClass('egmsRegions', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsSites', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsDelivery', MODX_CORE_PATH.'components/egms/model/egms/');
//$where = $modx->getOption('where', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

$cacheManager = $modx->getCacheManager();
$hash = "datahost-".$host;


if(!$hostdata = $cacheManager->get($hash))
{
    $hostdata = array();

    $my_region =$modx->getObject('egmsSites', array('host' => $host));
    $hostdata['region']['host'] = $my_region->get('host');
    $hostdata['region']['mainhost'] = implode(".", array_reverse(array_slice(array_reverse(explode(".", $my_region->get('host'))), 0, 2)));
    $hostdata['region']['alias'] = $my_region->get('alias')?$my_region->get('alias'):'info';
    $hostdata['region']['email'] = $hostdata['region']['alias'].'@'.$hostdata['region']['mainhost'];
    $hostdata['region']['phone'] = $my_region->get('phone');
    $hostdata['region']['phone_local'] = $my_region->get('phone_local');
    $hostdata['region']['region_address'] = $my_region->get('region_address');

    $city = $modx->getObject('egmsRegions', $my_region->get('id_region'));
    $hostdata['region']['city']['city'] = $city->get('city');
    $hostdata['region']['city']['city_i'] = $city->get('city_i');
    $hostdata['region']['city']['city_r'] = $city->get('city_r');
    $hostdata['region']['city']['city_d'] = $city->get('city_d');
    $hostdata['region']['city']['city_v'] = $city->get('city_v');
    $hostdata['region']['city']['city_t'] = $city->get('city_t');
    $hostdata['region']['city']['city_p'] = $city->get('city_p');
    // system
    $hostdata['region']['context'] = $my_region->get('context');
    $hostdata['region']['product_category_url'] = ($my_region->get('product_category_url')=='')?'catalog':$my_region->get('product_category_url');
    $hostdata['region']['code_yandex'] = $my_region->get('code_yandex');
    $hostdata['region']['code_google'] = $my_region->get('code_google');


    $vs = explode('||', $my_region->get('vendors'));
    foreach ($vs as $v)
        $hostdata['region']['vendors'][$v] = $v;

    //заполняем массивы категорий каталога сайта и продуктового катлога

    $my_categorys = $modx->getCollection("modResource", array(
        'context_key' => $my_region->get('context'),
        'class_key' => 'msCategory',
        'published' => 1,
        'deleted' => 0,
    ));

    $product_categorys = array();
    $site_categorys = array();

    foreach ($my_categorys as $my_category) {

        $tv = $modx->getObject('modTemplateVar',array('name'=>'catalog_map'));
        $ct = $tv->getValue($my_category->get('id'));

        if($ct!=""){
            $cms = array_merge($product_categorys, explode(",", $ct));
            foreach ($cms as $cm)
                $product_categorys[$cm] = $cm;
        }

        //проверка ринадлежности ресурса к производителю
        $tv = $modx->getObject('modTemplateVar',array('name'=>'access_vendor'));
        $c_vendor = $tv->getValue($my_category->get('id'));

        if($c_vendor==null){
            $site_categorys[$my_category->get('id')] = $my_category->get('id');
        }
        else{
            //если доступ указан, проверяем разрешен ли он для вэндора
            if(in_array($c_vendor, $hostdata['region']['vendors']))
                $site_categorys[$my_category->get('id')] = $my_category->get('id');
        }

    }

    $hostdata['region']['site_categorys_exc'] = explode(",", $my_region->get('site_categorys_exc'));
    $hostdata['region']['site_categorys_exc_all'] = ($my_region->get('site_categorys_exc')=='')?'':explode(",", "-".str_replace(",", ",-",$my_region->get('site_categorys_exc')));

    //убираем  site_categorys_exc из site_categorys
    foreach ($hostdata['region']['site_categorys_exc'] as $sc_exc)
        unset($site_categorys[$sc_exc]);

    $hostdata['region']['site_categorys'] = $site_categorys;

    $hostdata['region']['product_categorys_exc'] = explode(",", $my_region->get('product_categorys_exc'));

    //убираем  product_categorys_exc из product_categorys
    foreach ($hostdata['region']['product_categorys_exc'] as $pc_exc)
        unset($product_categorys[$pc_exc]);

    $hostdata['region']['product_categorys'] = empty($product_categorys)?'1':array_unique($product_categorys);
//    $product_categorys_exc_tmp = ($region->get('product_categorys_exc')=='')?'':explode(",", "-".str_replace(",", ",-",$region->get('product_categorys_exc')));
//    $hostdata['region']['product_categorys_all'] = array_merge($hostdata['region']['product_categorys'], $product_categorys_exc_tmp);

    //TODO: $hostdata['region']['filter_exc'] = $region->get('filter_exc');

    //$hostdata['region']['delivery_cost'] = 300;
    //$hostdata['region']['delivery_free_cost'] = 5000;


    $deliverys = $modx->getCollection('egmsDelivery',array(
        'id_region' => $my_region->get('id_region'),
        'id_vendor:IN' => $hostdata['region']['vendors'])
    );

    foreach ($deliverys as $delivery) {
        $hostdata['delivery']['vendor_'.$delivery->get('id_vendor')]['category_'.$delivery->get('id_category')] = array(
            'id_delivery' => $delivery->get('id'),
            'vendor' => $delivery->get('id_vendor'),
            'category' => $delivery->get('id_category'),
            'delivery_cost' => $delivery->get('d_cost'),
            'delivery_free_cost'=> $delivery->get('d_min'),
            'delivery_time' => $delivery->get('d_time'),
            'delivery_instock' => $delivery->get('d_instock'),
            'delivery_address' => $delivery->get('s_address'),
            );
    }

    $cacheManager->add($hash, $hostdata);
}

$output = $hostdata;
//die('<pre>'.print_r($output).'</pre>');
return $output;