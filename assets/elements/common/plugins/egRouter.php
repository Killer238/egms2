<?php
/*
 * Плагин делает доступными ресурсы для конкретного сайта.
 * если доступ не указан, то  ресурс доступен всем сайтам
 * доступ хранится в tv - access_vendor
 * Проверки:
 *  - видимость только товара по vendor
 *  - видимость ресурса для вэндора
 *  - проверка товара на включение в каталог сайта
 * */
switch ($modx->event->name) {

    case 'OnWebPagePrerender':
        $accessAllow = true;
        $datahost = $modx->runSnippet("egDataHost", []);
        $catalog_full = $modx->getContext($modx->context->key)->getOption('catalog_full');

        // редирект на основной хост если нет ни одного вэндора
        if($catalog_full!=1) {
            if (!$datahost['region']['vendors']){
                $modx->sendRedirect('//'.$datahost['region']['mainhost'], array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            }
        }

        // проверка на товар
        if ($modx->resource->class_key == 'msProduct')
        {

            if($catalog_full!=1) {
                $vendor = $modx->resource->get('vendor');
                // проверка товара на принадлежность ко включенному производителю
                if (!in_array ($vendor, $datahost['region']['vendors']))
                {
                    $accessAllow = false;
                }
            }
        }


        // доступность прочих страниц на принадлежность к вэндору
        if($vendors = (int)$modx->resource->getTVValue('access_vendor'))
        {
            if (!in_array ($vendors, $datahost['region']['vendors']))
            {
                $accessAllow = false;
            }
        }
        //die("-".$accessAllow);
        if(!$accessAllow){
            $modx->sendRedirect('//'.$_SERVER['HTTP_HOST'], array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            //$modx->sendErrorPage();
        }


        break;
}