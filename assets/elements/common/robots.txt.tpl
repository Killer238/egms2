User-agent: *
Allow: /*
{$_modx->runSnippet("pdoResources", [
    'where' => '{"searchable":"0"}',
    "parents" => '1',
    "depth" => '5',
    "limit" => '0',
    "tpl" => '@INLINE Disallow: {$uri}$'
])}


User-Agent: Googlebot
Allow: /*

User-agent: Googlebot-image
Disallow:

User-agent: YandexImages
Allow: /*

Host: {print_r($_modx->config)}

Sitemap: {$_modx->config.site_url}sitemap.xml
