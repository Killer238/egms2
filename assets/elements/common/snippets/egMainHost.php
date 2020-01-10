<?php
$host = implode(".", array_reverse(array_slice(array_reverse(explode(".", $_SERVER['HTTP_HOST'])), 0, 2)));
$where = $modx->getOption('where', $scriptProperties);
//die($host);
if ($where)
    $host = str_replace('HOST', $host, $where);
return $host;