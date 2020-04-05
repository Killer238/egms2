<?php
define('MODX_API_MODE', true);
include '/home/mh/mh/www/index.php';

$pages = $modx->getCollection("modResource", array("context_key" => "mas"));

foreach ($pages as $page)
{
    $id_page = $page->get('id');
    print $id_page;
    print " ".$page->get('pagetitle');
    print "\n\t";

    $seo_page = $modx->getCollection("egmsRd", array('resource_id' => $id_page, "host" => "*"));
    if (!$seo_page){
        $new_seo_page = array(
            'resource_id' => $seo_page['id'],
            'host' => "*",
            'title' => $page->get('pagetitle'),
            'meta_description' => $page->get('pagetitle'),
            'meta_keywords' => $page->get('pagetitle'),
            'h1' => $page->get('pagetitle'),
            'published' => 0
        );
        $psn = $modx->newObject('egmsRd');
        $psn->fromArray($new_seo_page);
        $psn->save();
    }
}

/*
$seo_page = $modx->getCollection("egmsRd", array('resource_id' => $id, "host" => "*"));
if (!$seo_page){
$new_seo_page = array(
'resource_id' => $id,
'host' => "*",
'title' => $resource->get('pagetitle'),
'meta_description' => $resource->get('pagetitle'),
'meta_keywords' => $resource->get('pagetitle'),
'h1' => $resource->get('pagetitle'),
'published' => 0
);
$psn = $modx->newObject('egmsRd');
$psn->fromArray($new_seo_page);
$psn->save();
}


*/