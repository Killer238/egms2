<?php
//TODO: прописать назначение плагина
//
//

$modx->loadClass('egmsSites', MODX_CORE_PATH.'components/egms/model/egms/');
//$modx->loadClass('egmsRegions', MODX_CORE_PATH.'components/egms/model/egms/');

switch ($modx->event->name) {
    case 'OnHandleRequest':

        if (!$pdo = $modx->getService('pdoFetch')) {
            return 'Could not load pdoFetch class!';
        }

        $host = $_SERVER['HTTP_HOST'];

        $q = $modx->newQuery('egmsSites');
        $q->where(
            array(
                'host' => $host,
                'published' => 1
            ));


        $region = $modx->getObject('egmsSites', $q);
        //die(print_r($region));

            if ($region) {
                $dh = $modx->runSnippet("egDataHost", []);
                $modx->setPlaceholder('region.host', $dh['region']['host']);
                $modx->setPlaceholder('region.mainhost', $dh['region']['mainhost']);
                $modx->setPlaceholder('region.alias', $dh['region']['alias']);
                $modx->setPlaceholder('region.product_category_url', $dh['region']['product_category_url']);

                $modx->setPlaceholder('region.phone', $dh['region']['phone']);
                $modx->setPlaceholder('region.phone_local', $dh['region']['phone_local']);
                $modx->setPlaceholder('region.mail', $dh['region']['email']);
                $modx->setPlaceholder('region.region_address', $dh['region']['region_address']);

                $them = $modx->getContext($dh['region']['context'])->getOption('themplate_name');
                $them = ($them)?$them:$modx->getOption('themplate_name');
                $modx->setPlaceholder('themplate_name', $them);

                $modx->setPlaceholder('region.city', $dh['region']['city']['city']);
                $modx->setPlaceholder('region.city_i', $dh['region']['city']['city_i']);
                $modx->setPlaceholder('region.city_r', $dh['region']['city']['city_r']);
                $modx->setPlaceholder('region.city_d', $dh['region']['city']['city_d']);
                $modx->setPlaceholder('region.city_v', $dh['region']['city']['city_v']);
                $modx->setPlaceholder('region.city_t', $dh['region']['city']['city_t']);
                $modx->setPlaceholder('region.city_p', $dh['region']['city']['city_p']);

                $modx->setPlaceholder('region.vendors', $dh['region']['vendors']);

                $modx->setPlaceholder('region.product_category_url', $dh['region']['product_category_url']);
                $modx->setPlaceholder('delivery', $dh['delivery']);
                return;
            } else {
                $main_host = implode(".", array_reverse(array_slice(array_reverse(explode('.', $host)), 0, 2)));
                if($main_host!=$host)
                    $modx->sendRedirect('//'.$main_host, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            }

            break;

    /*
        case 'OnLoadWebDocument':
            $content = $Seodomains->getContent($_SERVER['HTTP_HOST'], $modx->resource->id);

            if (!$content) return ;

            $modx->resource->cacheable = 0;
            $modx->resource->content = $content;
            break;
    */
}