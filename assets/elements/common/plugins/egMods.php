<?php

switch ($modx->event->name) {
    case 'pdoToolsOnFenomInit':

        $fenom->addModifier('ceodata', function ($input, $key) {
            return $input[$key];
        });

        $fenom->addModifier('delivery', function ($input, $key) {
            //return "key -" . $key['vendor']."-".$key['therm'];
            //return "-".print_r($input);
            return print_r($input[$key['vendor']."-".$key['therm']]);
        });

        $fenom->addModifier('cdesc', function ($input, $key) {
            $rows = json_decode($input, 1);
            foreach($rows as $row)
                if($row['context']==$key)
                    return $row['desc'];
            return "";
        });

        $fenom->addModifier('purl', function ($input, $key) {
            return str_replace("https://".$_SERVER['HTTP_HOST'], $key, $input);
        });

        $fenom->addModifier('themepath', function ($input, $key) {
            return "file:".$input."/".$key;
        });

        $fenom->addModifier('size', function ($input, $key) {
            return $_GET['msoption|size']?" - ".$_GET['msoption|size']." {'eg_sm'| lexicon}".$key:"";
        });
/*
        $fenom->addModifier('price_format', function ($input) {
            $price = str_replace(',','.',$input);
            $options = json_decode([2, ".", " "]);//$options = json_decode($modx->getOption('ms2_price_format'));
            if (is_array($options)) {
                return number_format($price, $options[0], $options[1], $options[2]);
            } else {
                return $price;
            }
        });*/
        break;
}