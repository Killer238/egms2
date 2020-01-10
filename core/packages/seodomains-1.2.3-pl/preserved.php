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
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => '',
      'namespace' => 'seodomains',
    ),
  ),
  '16845d29754f1cbedfe6aa8006e31008' => 
  array (
    'criteria' => 
    array (
      'name' => 'SeoDomainsList',
    ),
    'object' => 
    array (
      'id' => 57,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'SeoDomainsList',
      'description' => '',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'snippet' => '/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\')) {
    return \'Could not load Seodomains class!\';
}

/* @var pdoFetch $pdoFetch */
if (!$modx->loadClass(\'pdofetch\', MODX_CORE_PATH . \'components/pdotools/model/pdotools/\', false, true)) {return false;}
$pdoFetch = new pdoFetch($modx, $scriptProperties);

$config = $Seodomains->config;

// Set default parameters
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'SeoDomains.City.tpl\');
$activeClass = $modx->getOption(\'activeClass\', $scriptProperties, \'active\');
$sortby = $modx->getOption(\'sortby\', $scriptProperties, \'city\');
$sortdir = $modx->getOption(\'sortdir\', $scriptProperties, \'ASC\');
$limit = $modx->getOption(\'limit\', $scriptProperties, \'\');
$showLog = $modx->getOption(\'showLog\', $scriptProperties, 0);
$js = $modx->getOption(\'frontend_js\', $scriptProperties, $config[\'jsUrl\'] . "web/default.js");

if (!empty($js) && preg_match(\'/\\.js/i\', $js)) {
    $modx->regClientScript($js);
}

$default = array(
    \'class\' => \'SeodomainsCity\',
    \'sortby\' => $sortby,
    \'sortdir\' => $sortdir,
    \'limit\' => $limit,
    \'fastMode\' => false,
    \'return\' => \'data\',
);

$pdoFetch->setConfig(array_merge($default, $scriptProperties));
$rows = $pdoFetch->run();

// Processing data
$pdoFetch->addTime(\'Parsing data\');
$output = array();

foreach ($rows as $row) {
    $output[] = array_merge($row, array(
        \'active\' => $row[\'domain\'] == $_SERVER[\'HTTP_HOST\'] ? $activeClass : \'\',
        \'link\' => "//{$row[\'domain\']}{$_SERVER[\'REQUEST_URI\']}"
    ));
}

$pdoFetch->addTime(\'Returning parsed data\');

// Return output
$log = \'\';
if ($modx->user->hasSessionContext(\'mgr\') && !empty($showLog)) {
    $log .= \'<pre class="SeodomainsLog">\' . print_r($pdoFetch->getTime(), 1) . \'</pre>\';
}

$output = $pdoFetch->getChunk($tpl, array(\'rows\' => $output));

$output .= $log;

return $output;',
      'locked' => 0,
      'properties' => 'a:6:{s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:19:"seodomains_prop_tpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:19:"SeoDomains.City.tpl";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}s:11:"activeClass";a:7:{s:4:"name";s:11:"activeClass";s:4:"desc";s:27:"seodomains_prop_activeClass";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:6:"active";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}s:6:"sortby";a:7:{s:4:"name";s:6:"sortby";s:4:"desc";s:22:"seodomains_prop_sortby";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:4:"city";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}s:7:"sortdir";a:7:{s:4:"name";s:7:"sortdir";s:4:"desc";s:23:"seodomains_prop_sortdir";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:3:"ASC";s:5:"value";s:3:"ASC";}i:1;a:2:{s:4:"text";s:4:"DESC";s:5:"value";s:4:"DESC";}}s:5:"value";s:3:"ASC";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}s:5:"limit";a:7:{s:4:"name";s:5:"limit";s:4:"desc";s:21:"seodomains_prop_limit";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}s:7:"showLog";a:7:{s:4:"name";s:7:"showLog";s:4:"desc";s:23:"seodomains_prop_showLog";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:1:"0";s:7:"lexicon";s:21:"seodomains:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/seodomains/elements/snippets/SeoDomainsList.php',
      'content' => '/* @var Seodomains $Seodomains */
if (!$Seodomains = $modx->getService(\'Seodomains\', \'Seodomains\', MODX_CORE_PATH . \'components/seodomains/model/\')) {
    return \'Could not load Seodomains class!\';
}

/* @var pdoFetch $pdoFetch */
if (!$modx->loadClass(\'pdofetch\', MODX_CORE_PATH . \'components/pdotools/model/pdotools/\', false, true)) {return false;}
$pdoFetch = new pdoFetch($modx, $scriptProperties);

$config = $Seodomains->config;

// Set default parameters
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'SeoDomains.City.tpl\');
$activeClass = $modx->getOption(\'activeClass\', $scriptProperties, \'active\');
$sortby = $modx->getOption(\'sortby\', $scriptProperties, \'city\');
$sortdir = $modx->getOption(\'sortdir\', $scriptProperties, \'ASC\');
$limit = $modx->getOption(\'limit\', $scriptProperties, \'\');
$showLog = $modx->getOption(\'showLog\', $scriptProperties, 0);
$js = $modx->getOption(\'frontend_js\', $scriptProperties, $config[\'jsUrl\'] . "web/default.js");

if (!empty($js) && preg_match(\'/\\.js/i\', $js)) {
    $modx->regClientScript($js);
}

$default = array(
    \'class\' => \'SeodomainsCity\',
    \'sortby\' => $sortby,
    \'sortdir\' => $sortdir,
    \'limit\' => $limit,
    \'fastMode\' => false,
    \'return\' => \'data\',
);

$pdoFetch->setConfig(array_merge($default, $scriptProperties));
$rows = $pdoFetch->run();

// Processing data
$pdoFetch->addTime(\'Parsing data\');
$output = array();

foreach ($rows as $row) {
    $output[] = array_merge($row, array(
        \'active\' => $row[\'domain\'] == $_SERVER[\'HTTP_HOST\'] ? $activeClass : \'\',
        \'link\' => "//{$row[\'domain\']}{$_SERVER[\'REQUEST_URI\']}"
    ));
}

$pdoFetch->addTime(\'Returning parsed data\');

// Return output
$log = \'\';
if ($modx->user->hasSessionContext(\'mgr\') && !empty($showLog)) {
    $log .= \'<pre class="SeodomainsLog">\' . print_r($pdoFetch->getTime(), 1) . \'</pre>\';
}

$output = $pdoFetch->getChunk($tpl, array(\'rows\' => $output));

$output .= $log;

return $output;',
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
      'disabled' => 0,
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