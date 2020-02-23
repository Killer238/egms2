<?php
$case = 1;
if($case==1) {
    $id_product = 3405; //комод
    $w = 90;
    $l=83;
}
if($case==2) {
    $id_product = 4168; //кровать с основаниями
    $w = 70;
    $l=190;
}
if($case==3){
    $id_product = 4205; //подушка с одним размером 21х24
    $w = 21;
    $l=24;
}


$url = 'https://www.matras.ru/api/catalog/item/'.$id_product.
    '?common=true&sizes=true&kits=true&colors=true&filter_width='.$w.'&filter_length='.$l;

$json = file_get_contents($url);

$base_data = json_decode($json,1);

$result2 = array(
    'options' => array('color' => array(), 'kit'=>array())
);
foreach ($base_data as $key => $data_group){
    $needle = array('colors', 'sizes', 'kits');
    if(in_array($key, $needle)){
        foreach ($data_group as $option){
            if($key == 'colors')
                $result2['options']['color'][]= array(
                    'id' => $option['id'],
                    'name' => $option['name'],
                    'image' => $option['url']
                );
            if($key == 'sizes')
                $result2['options']['size'][]= array(
                    'id' => $option['id'],
                    'name' => $option['w'].'x'.$option['h'],
                    'price' => $option['price'],
                    'old_price' => $option['discount_price'],
                );
            if($key == 'kits')
                $result2['options']['kit'][]= array(
                    'id' => $option['id'],
                    'name' => $option['kits'],
                );
        }
    }
}
for($i=0;$i<1;$i++)
foreach ($result2['options']['kit'] as $kit)
{
    foreach ($result2['options']['color'] as $color)
        $t = 1;
}

print_r($result2);