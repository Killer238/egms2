<?php
$modx->loadClass('egmsRegions', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsSites', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsDelivery', MODX_CORE_PATH.'components/egms/model/egms/');
$modx->loadClass('egmsDeliveryOptions', MODX_CORE_PATH.'components/egms/model/egms/');

//$where = $modx->getOption('where', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

$cacheManager = $modx->getCacheManager();
$hash = "datahost-".$host;


if(!$hostdata = $cacheManager->get($hash))
{
    $hostdata = array();

    $my_region =$modx->getObject('egmsSites', array('host' => $host));
    $hostdata['region']['id_region'] = $my_region->get('id_region');
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
    $hostdata['region']['city']['city_in'] = $city->get('city_in');
    $hostdata['region']['city']['city_on'] = $city->get('city_on');
    // system
    $hostdata['region']['context'] = $my_region->get('context');
    $hostdata['region']['product_category_url'] = ($my_region->get('product_category_url')=='')?'catalog':$my_region->get('product_category_url');
    $hostdata['region']['code_yandex'] = $my_region->get('code_yandex');
    $hostdata['region']['code_google'] = $my_region->get('code_google');


    $vs = explode('||', $my_region->get('vendors'));
    //
    //die(print_r($vs));
    //die("-". $my_region->get('id_region'));
    $where = array(
        'id_therm'=> 0,
        'published' => 1,
        'id_region' =>  $my_region->get('id_region'),
        'id_vendor:NOT IN' => $vs,
        );

    $deliverys = $modx->getCollection('egmsDelivery', $where);
    foreach ($deliverys as $delivery){
        $v = $delivery->get('id_vendor');
        $hostdata['region']['vendors'][$v] = $v;
    }

    //заполняем массивы категорий каталога сайта и продуктового катлога
    /*
    $my_categorys = $modx->getCollection("modResource", array(
        'context_key' => $my_region->get('context'),
        'class_key' => 'msCategory',
        'published' => 1,
        'deleted' => 0,
    ));*/

    //$product_categorys = array();
    //$site_categorys = array();

    /*foreach ($my_categorys as $my_category) {

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

    }*/

    //$hostdata['region']['site_categorys_exc'] = explode(",", $my_region->get('site_categorys_exc'));
    //$hostdata['region']['site_categorys_exc_all'] = ($my_region->get('site_categorys_exc')=='')?'':explode(",", "-".str_replace(",", ",-",$my_region->get('site_categorys_exc')));

    //убираем  site_categorys_exc из site_categorys
    //foreach ($hostdata['region']['site_categorys_exc'] as $sc_exc)
    //    unset($site_categorys[$sc_exc]);

    //$hostdata['region']['site_categorys'] = $site_categorys;

    //$hostdata['region']['product_categorys_exc'] = explode(",", $my_region->get('product_categorys_exc'));

    //убираем  product_categorys_exc из product_categorys
    //foreach ($hostdata['region']['product_categorys_exc'] as $pc_exc)
    //    unset($product_categorys[$pc_exc]);

    //$hostdata['region']['product_categorys'] = empty($product_categorys)?'1':array_unique($product_categorys);
//    $product_categorys_exc_tmp = ($region->get('product_categorys_exc')=='')?'':explode(",", "-".str_replace(",", ",-",$region->get('product_categorys_exc')));
//    $hostdata['region']['product_categorys_all'] = array_merge($hostdata['region']['product_categorys'], $product_categorys_exc_tmp);

    //TODO: $hostdata['region']['filter_exc'] = $region->get('filter_exc');

    //$hostdata['region']['delivery_cost'] = 300;
    //$hostdata['region']['delivery_free_cost'] = 5000;

    //$catalog_full = $modx->getContext($modx->context->key)->getOption('catalog_full');
    //if($catalog_full!=1) {
        $deliverys_t = $modx->getCollection('egmsDelivery',array(
            'id_region' => $my_region->get('id_region'),
            //'id_category' => $hostdata['region']['vendors'],
            'id_vendor:NOT IN'=> $vs,
            'published'=> '1',
        ));
  /*  }else
    {

        $query = $modx->newQuery('egmsDelivery');
        //$query->select($modx->getSelectColumns('msVendor'));
        //$query->select($modx->getSelectColumns('egmsDelivery'));
                $query->select(array(
            'egmsDelivery.id',
            'egmsDelivery.content',
            'egmsDelivery.d_payments',
            'egmsDelivery.d_cost',
            'egmsDelivery.d_min',
            'egmsDelivery.d_dayscount',
            'egmsDelivery.d_datehide',
            'egmsDelivery.d_days',
            'egmsDelivery.d_time',
            'egmsDelivery.d_weekdays',
            'egmsDelivery.d_skeep',
            'egmsDelivery.d_instock',
            'egmsDelivery.s_address',
            'egmsDelivery.delivery_options',
        ));
        $query->rightJoin('msVendor','msVendor', 'egmsDelivery.id_vendor = msVendor.id');
        $deliverys_t = $modx->getCollection('egmsDelivery',$query);
    }*/

    $hostdata['delivery']['0-0'] = array(
        'id_delivery' => 0,
        'd_content' => '',
        'd_payments' => '',
        'd_cost' => 550,
        'd_min'=> 5000,

        'd_dayscount'=> 5,
        'd_datehide'=> '',
        'd_days' => '35 дней',
        'd_time' => '15',
        'd_weekdays' => '1111111',
        'd_skeep' => '',

        'd_instock' => 0,
        's_address' => '',
        'delivery_options' => '',
    );

    foreach ($deliverys_t as $delivery) {

        $key = $delivery->get('id_vendor')."-".$delivery->get('id_therm');
        $hostdata['delivery'][$key] = array(
            'id_delivery' => $delivery->get('id'),
            'd_content' => $delivery->get('content'),
            'd_payments' => $delivery->get('d_payments'),
            'd_cost' => $delivery->get('d_cost'),
            'd_min'=> $delivery->get('d_min'),

            'd_dayscount'=> $delivery->get('d_dayscount'),
            'd_datehide'=> $delivery->get('d_datehide'),
            'd_days' => $delivery->get('d_days'),
            'd_time' => $delivery->get('d_time'),
            'd_weekdays' => $delivery->get('d_weekdays'),
            'd_skeep' => '', //explode(',', '28.02.2020,29.02.2020'),

            'd_instock' => $delivery->get('d_instock'),
            's_address' => $delivery->get('s_address'),
            'delivery_options' => $delivery->get('delivery_options'),
            );
        $payments = $modx->getCollection('msPayment');
        foreach ($payments as $payment)
        {
            $id = $payment->get('id');
            $hostdata['payments'][$id] = array(
                'id' => $id,
                'name' =>  $payment->get('name'),
                'desc' =>  $payment->get('description'),
            );
        }

        $options = $modx->getCollection('egmsDeliveryOptions');
        foreach ($options as $option)
        {
            $id = $option->get('id');
            $hostdata['options'][$id] = array(
                'id' => $id,
                'option' =>  $option->get('option'),
                'val' =>  $option->get('val'),
            );
        }

    }

    $cacheManager->add($hash, $hostdata);
}

$output = $hostdata;
//die('<pre>'.print_r($output).'</pre>');
return $output;