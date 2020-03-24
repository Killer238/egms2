<?php
$modx->loadClass('egmsRd', MODX_CORE_PATH.'components/egms/model/egms/');

$type = $modx->getOption('type', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];

if($modx->resource->searchable){
    $robots = "index, follow";
}else{
    $robots = "noindex, nofollow";
}

$new_ceo_data = array();

if($modx->resource->class_key=="msProduct"){
    $canonical = $modx->resource->uri;
    //дополнительно пытаемся найти в шаблоне каталога
    $id_base_catalog = $modx->getContext($modx->context->key)->getOption('base_catalog');
    $rd = $modx->getCollection('egmsRd', array('resource_id' => $id_base_catalog, 'published' => 1));

    $base_object = $modx->getObject("modResource", array('id' => $id_base_catalog));
    $base_uri = $base_object->get('uri');
    $canonical = "catalog/".$canonical; //$base_uri.$canonical;
    $canonical .= $_GET['msoption|size'] ? $_GET['msoption|size'] . '/' : "";
    $canonical .= $_GET['reviews'] ? $_GET['reviews'] . '/' : "";

    $vendor = $modx->getPlaceholder('vendor');
    $vendors = $modx->getPlaceholder('region.vendors');
    if (!in_array($vendor, $vendors))
    {
        $robots = "noindex, nofollow";
    }
    
    if($rd){
        foreach ($rd as $r) {
            $new_ceo_data[$r->get('host')]['meta_title'] = $r->get('title');
            $new_ceo_data[$r->get('host')]['meta_description'] = $r->get('meta_description');
            $new_ceo_data[$r->get('host')]['meta_keywords'] = $r->get('meta_keywords');
            $new_ceo_data[$r->get('host')]['h1'] = $r->get('h1');
            $new_ceo_data[$r->get('host')]['description_intro'] = $r->get('description_intro');
            $new_ceo_data[$r->get('host')]['description'] = $r->get('description');
            $new_ceo_data[$r->get('host')]['description2'] = $r->get('description2');
            $new_ceo_data[$r->get('host')]['description3'] = $r->get('description3');
            $new_ceo_data[$r->get('host')]['robots'] = $robots;
            $new_ceo_data[$r->get('host')]['canonical'] = $canonical;
        }
    }else{
        $new_ceo_data['*']['meta_title'] = $modx->getContext($modx->context->key)->getOption('template_product_title');
        $new_ceo_data['*']['meta_description'] = $modx->getContext($modx->context->key)->getOption('template_product_description');
        $new_ceo_data['*']['meta_keywords'] = '';
        $new_ceo_data['*']['h1'] = $modx->getContext($modx->context->key)->getOption('template_product_h1');
        $new_ceo_data['*']['description_intro'] = '';
        $new_ceo_data['*']['meta_keywords'] = '';
        $new_ceo_data['*']['description2'] = '';
        $new_ceo_data['*']['description3'] = '';
        $new_ceo_data['*']['robots'] = "noindex, nofollow";
        $new_ceo_data['*']['canonical'] = $canonical;
    }
}else{
    //для прочих страниц
    $rd = $modx->getCollection('egmsRd', array('resource_id' => $modx->resource->id, 'published' => 1));
    $canonical = $modx->makeUrl($modx->resource->id);
    if($rd)
    {
        foreach ($rd as $r) {
            $new_ceo_data[$r->get('host')]['meta_title'] = $r->get('title');
            $new_ceo_data[$r->get('host')]['meta_description'] = $r->get('meta_description');
            $new_ceo_data[$r->get('host')]['meta_keywords'] = $r->get('meta_keywords');
            $new_ceo_data[$r->get('host')]['h1'] = $r->get('h1');
            $new_ceo_data[$r->get('host')]['description_intro'] = $r->get('description_intro');
            $new_ceo_data[$r->get('host')]['description'] = $r->get('description');
            $new_ceo_data[$r->get('host')]['description2'] = $r->get('description2');
            $new_ceo_data[$r->get('host')]['description3'] = $r->get('description3');
            $new_ceo_data[$r->get('host')]['robots'] = $robots;
            $new_ceo_data[$r->get('host')]['canonical'] = $canonical;
        }
    }else{
        //
        $new_ceo_data['*']['meta_title'] = $modx->resource->pagetitle;
        $new_ceo_data['*']['meta_description'] = $modx->resource->introtext;
        $new_ceo_data['*']['meta_keywords'] = $modx->resource->longtitle;
        $new_ceo_data['*']['h1'] = $modx->resource->longtitle;
        $new_ceo_data['*']['description_intro'] = '';
        $new_ceo_data['*']['description'] = $modx->resource->description;
        $new_ceo_data['*']['description2'] = '';
        $new_ceo_data['*']['description3'] = '';
        //если не найден шаблон, то в поиске не показываем
        $new_ceo_data['*']['robots'] = "noindex, nofollow";
        $new_ceo_data['*']['canonical'] = $canonical;
    }

}

if($new_ceo_data[$host])
    $output = $new_ceo_data[$host];
else
    $output = $new_ceo_data['*'];
//die(print_r($output));

return $output;