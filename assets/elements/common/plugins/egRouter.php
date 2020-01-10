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

        // проверка на товар
        if ($modx->resource->class_key == 'msProduct')
        {
            $vendor = $modx->resource->get('vendor');
            // проверка товара на принадлежность ко включенному производителю
            if (!in_array ($vendor, $datahost['region']['vendors']))
            {
                $accessAllow = false;
            }

            // проверка на включение в каталог сайта
            $parent = $modx->resource->parent;
            if(!in_array($parent, $datahost['region']['product_categorys']))
            {
                $accessAllow = false;
            }
            //if(!$accessAllow)
            //    die("false");
            //else
            //    die("true");
            //if(!$accessAllow)
            //    $modx->sendErrorPage();
        }

        // доступность прочих страниц на принадлежность к вэндору
        if($vendors = (int)$modx->resource->getTVValue('access_vendor'))
        {
            if (in_array ($vendors, $datahost['region']['vendors']))
            {
                $accessAllow = false;
            }

           // if(!$accessAllow)
            //    $modx->sendErrorPage();
        }



        break;
}