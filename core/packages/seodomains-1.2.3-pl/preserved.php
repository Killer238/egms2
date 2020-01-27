<?php return array (
  '16b042891d026b2ec4341472d47b7fd2' => 
  array (
    'criteria' => 
    array (
      'text' => 'seodomains',
    ),
    'object' => 
    array (
      'text' => 'seodomains',
      'parent' => 'components',
      'action' => 'home',
      'description' => 'seodomains_menu_desc',
      'icon' => '',
      'menuindex' => 6,
      'params' => '',
      'handler' => '',
      'permissions' => '',
      'namespace' => 'seodomains',
    ),
  ),
  '92174cdf3bc139071f6e558d0bb8daaa' => 
  array (
    'criteria' => 
    array (
      'name' => 'SeoDomains',
    ),
    'object' => 
    array (
      'id' => 19,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'SeoDomains',
      'description' => '',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\')) {
    return \'Could not load Seodomains class!\';
}

switch ($modx->event->name) {
    case \'OnHandleRequest\':
        /* @var pdoFetch $pdoFetch */
        if (!$pdo = $modx->getService(\'pdoFetch\')) {
            return \'Could not load pdoFetch class!\';
        }
        
        $host = $_SERVER[\'HTTP_HOST\'];

        if ($modx->getOption(\'seodomains_cyrillic_domain\')) {
            $host = idn_to_utf8($host);
        }

        $response = $pdo->getArray(\'SeodomainsCity\', array(\'domain\' => $host));

        if (count($response)) {
            $Morefields = $Seodomains->getMorefields($response[\'id\']);

            $modx->setPlaceholders(array_merge($response, $Morefields), $modx->getOption(\'seodomains_phx_prefix\'));
        } else {
            if (!$modx->getOption(\'seodomains_main_host\')) return;

            $modx->sendRedirect($modx->getOption(\'seodomains_main_host\'), array(\'responseCode\' => \'HTTP/1.1 301 Moved Permanently\'));
        }
    break;
    
    case \'OnDocFormRender\':
        $controller->Seodomains = $Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\');

        $controller->Seodomains->loadCustomJsCss();
    break;

    case \'OnLoadWebDocument\':
        $content = $Seodomains->getContent($_SERVER[\'HTTP_HOST\'], $modx->resource->id);
        
        if (!$content) return ;
        
        $modx->resource->cacheable = 0;
        $modx->resource->content = $content;
    break;
}',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 1,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/seodomains/elements/plugins/SeoDomains.php',
      'content' => '/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\')) {
    return \'Could not load Seodomains class!\';
}

switch ($modx->event->name) {
    case \'OnHandleRequest\':
        /* @var pdoFetch $pdoFetch */
        if (!$pdo = $modx->getService(\'pdoFetch\')) {
            return \'Could not load pdoFetch class!\';
        }
        
        $host = $_SERVER[\'HTTP_HOST\'];

        if ($modx->getOption(\'seodomains_cyrillic_domain\')) {
            $host = idn_to_utf8($host);
        }

        $response = $pdo->getArray(\'SeodomainsCity\', array(\'domain\' => $host));

        if (count($response)) {
            $Morefields = $Seodomains->getMorefields($response[\'id\']);

            $modx->setPlaceholders(array_merge($response, $Morefields), $modx->getOption(\'seodomains_phx_prefix\'));
        } else {
            if (!$modx->getOption(\'seodomains_main_host\')) return;

            $modx->sendRedirect($modx->getOption(\'seodomains_main_host\'), array(\'responseCode\' => \'HTTP/1.1 301 Moved Permanently\'));
        }
    break;
    
    case \'OnDocFormRender\':
        $controller->Seodomains = $Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\');

        $controller->Seodomains->loadCustomJsCss();
    break;

    case \'OnLoadWebDocument\':
        $content = $Seodomains->getContent($_SERVER[\'HTTP_HOST\'], $modx->resource->id);
        
        if (!$content) return ;
        
        $modx->resource->cacheable = 0;
        $modx->resource->content = $content;
    break;
}',
    ),
  ),
  'ba1602faffed065756caae5cde53d337' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnHandleRequest',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnHandleRequest',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '1eb14ec3ab412191f1d632b002cff1e4' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '1104f5138f9f112ce6f5f510666a8ec8' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 19,
      'event' => 'OnLoadWebDocument',
    ),
    'object' => 
    array (
      'pluginid' => 19,
      'event' => 'OnLoadWebDocument',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);