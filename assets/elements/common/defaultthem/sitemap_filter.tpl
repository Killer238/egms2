{*var $dh = $_modx->runSnippet("egDataHost", [])}
{var $host = $dh["region"]["host"]}
{var $pc =  $dh['region']['site_categorys']}
{var $parent = implode(",", $pc)}
{$_modx->runSnippet("sfSitemap", [
"fast" => 1,
"mincount" => 0,
"cacheKey" => $_modx->config.site_url,
"where" => '{"sfUrls.page_id:IN":['~ $parent ~']}',
'showLog' => 1,
"tpl" => '@INLINE <url>
    <loc>{$url}</loc>
    <lastmod>{$date}</lastmod>
    <changefreq>{$update}</changefreq>
    <priority>{$priority}</priority>
</url>'
])*}
