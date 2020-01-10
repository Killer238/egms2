<?php

switch ($modx->event->name) {
    case 'pdoToolsOnFenomInit':

        $fenom->addModifier('ceodata', function ($input, $key) {
            return $input[$key];
        });

        $fenom->addModifier('purl', function ($input, $key) {
            return str_replace("https://".$_SERVER['HTTP_HOST'], $key, $input);;
        });

        break;
}