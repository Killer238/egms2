<?php
/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService('Seodomains', 'Seodomains', MODX_CORE_PATH . 'components/seodomains/model/')) {
    return 'Could not load Seodomains class!';
}

switch ($modx->event->name) {
    case 'OnHandleRequest':
        /* @var pdoFetch $pdoFetch */
        if (!$pdo = $modx->getService('pdoFetch')) {
            return 'Could not load pdoFetch class!';
        }
        
        $host = $_SERVER['HTTP_HOST'];

        if ($modx->getOption('seodomains_cyrillic_domain')) {
            $host = idn_to_utf8($host);
        }

        $response = $pdo->getArray('SeodomainsCity', array('domain' => $host));

        if (count($response)) {
            $Morefields = $Seodomains->getMorefields($response['id']);

            $modx->setPlaceholders(array_merge($response, $Morefields), $modx->getOption('seodomains_phx_prefix'));
        } else {
            if (!$modx->getOption('seodomains_main_host')) return;

            $modx->sendRedirect($modx->getOption('seodomains_main_host'), array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
        }
    break;
    
    case 'OnDocFormRender':
        $controller->Seodomains = $Seodomains = $modx->getService('Seodomains', 'Seodomains', MODX_CORE_PATH . 'components/seodomains/model/');

        $controller->Seodomains->loadCustomJsCss();
    break;

    case 'OnLoadWebDocument':
        $content = $Seodomains->getContent($_SERVER['HTTP_HOST'], $modx->resource->id);
        
        if (!$content) return ;
        
        $modx->resource->cacheable = 0;
        $modx->resource->content = $content;
    break;
}