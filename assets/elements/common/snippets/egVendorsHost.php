<?php
$where = $modx->getOption('where', $scriptProperties);
$host = $_SERVER['HTTP_HOST'];
$vh = $modx->runSnippet('egDataHost');
$str=array(
    $where => $vh['region']['vendors'],
);
$output = $modx->toJSON($str);
//die($output);
return $output;