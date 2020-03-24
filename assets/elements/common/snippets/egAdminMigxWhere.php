<?php
/*
 * недоделано
 *
 */

$where = $modx->getOption('where', $scriptProperties);
$id = $modx->getOption('id', $scriptProperties);
$result = array();




/*
$collections = explode(",", $where);

foreach ($collections as $collection){

}*/
//$modx->log(1, 'grishin_top: '.$_GET['id']);

/*
$res = $modx->getObject("modResource", array('id' => $modx->resource->id));

if($where=='product'){
    $val = $modx->resource->id;
    $result = array(
        'id_product' => $val
    );
}
if($where=='context') {
    //$val = $res->get('context_key');
    $modx->log(1, 'grishin: '.$modx->resource->id);
    //die($val);
    $val = "mas";
    $result = array(
        'context' => $val
    );
}
*/
return json_encode($result);