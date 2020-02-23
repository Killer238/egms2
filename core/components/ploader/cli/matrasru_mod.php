<?php
define('MODX_API_MODE', true);
include dirname(dirname(dirname(dirname(__DIR__)))).'/index.php';

$id_product = 403;//38;

$sql = "DELETE FROM ".$modx->config['table_prefix']."msop_colors where rid=".$id_product;
$count = $modx->exec($sql);

die($count);
//delete модификации
$modx->call('msopModification', 'removeProductModification', array(&$modx, $id_product, array(array())));

//создаем модификации
$modification = array(
    array(
        'name' => 'size',
        'price' => 100,
        'old_price' => 150,
        'options' => array(
            'size' => '100x200',
            'color' =>'красный'
            )
        ),
    array(
        'name' => 'size',
        'price' => 200,
        'old_price' => 250,
        'options' => array(
            'size' => '200x200',
            'color' => 'зеленый'
        )
    )
);
if($modification)
{
    $modx->call('msopModification',
        'saveProductModification',
        array(&$modx, $id_product, $modification));
}