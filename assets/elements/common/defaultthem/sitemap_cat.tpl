{**
Выводятся страницы сайта(не товары):
вычитаются скрытые ресурсы
"cache_key" => $host,
**}
{$_modx->runSnippet("pdositemap", [
"parents" => '0' ,
"showHidden" => 1,
"sortby" => "uri",
"includeTVs" => "access_vendor",
"where" => '[[{"access_vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'},{"OR:access_vendor:IS":null}]]',
'showLog' => 0,
"tpl" =>
('@INLINE <url>
        <loc>https://'~ $_modx->getPlaceholder('region.host') ~'/{$uri}</loc>
        <lastmod>{$date}</lastmod>
        <changefreq>{$update}</changefreq>
        <priority>{$priority}</priority>
</url>')
])}
