<?php
$showhome = $modx->getOption('showHome', $scriptProperties);
$showathome = $modx->getOption('showAtHome', $scriptProperties);
$tpl = $modx->getOption('tpl', $scriptProperties);
$tplcurrent = $modx->getOption('tplCurrent', $scriptProperties);
$tplwrapper = $modx->getOption('tplWrapper', $scriptProperties);

$pdo = $modx->getService('pdoTools');
if (!($pdo instanceof pdoTools)) {
    return '';
}

$arr = array(
    'showHome' => $showhome,
    'showAtHome' => $showathome,
    'tpl' => $tpl,
    'tplCurrent' => $tplcurrent,
    'tplWrapper' => $tplwrapper,
);

if($modx->resource->class_key=="msProduct"){

    $parent = $modx->resource->parent;
    $cat_id = 2137;

    $where = $modx->newQuery('modResource');
    $where->leftJoin('modTemplateVarResource', 'TemplateVarResources');
    $where->leftJoin('modTemplateVar', 'tv', "tv.id=TemplateVarResources.tmplvarid");
    $where->limit(5);// Лимит
    $where->where(array(
        array(
            'tv.name'   => 'catalog_map', // Имя TV
            'context_key' => $modx->context->key,
            'TemplateVarResources.value'    => $parent,// Значение TV
        )
    ));
    $resources = $modx->getCollection('modResource',$where);
    //die("-".count($resources));
    foreach ($resources as $resource){
        $cat_id = $resource->get('id');
        break;
    }

    if ($cat_id > 0){
        $res = $modx->getObject('modResource', $modx->resource->id);
        $title = $res->get('longtitle');
        $arr['to'] = $cat_id;
        $arr['showCurrent'] = 1;
        $arr['tplCurrent'] = $tpl;
        $current = $output = $pdo->getChunk($tplcurrent, array('menutitle' => $title), false);
        $arr['tplWrapper'] = str_replace('{$output}','{$output}'.$current, $tplwrapper);
    }
}

$result = $modx->runSnippet("pdoCrumbs", $arr);

return $result;