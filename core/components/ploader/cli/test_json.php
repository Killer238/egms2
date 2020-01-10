<?php
//$url = "https://www.matras.ru/api/catalog/item/4480?common=true&sizes=true&kits=true&colors=true&filter_width=140&filter_length=200&size=1381519&color=1873&kit=3034";
//$url = "https://www.matras.ru/api/catalog/item/186?common=true&sizes=true&kits=true&colors=true&filter_width=80&filter_length=195&size=2292422&color=0";
$url = "https://www.matras.ru/api/catalog/item/4440?common=true&sizes=true&kits=true&colors=true&filter_width=50&filter_length=70";
$json_text = file_get_contents($url);

$json = json_decode($json_text, true);

//print_r ($json['sizes']);

print_r($json);
