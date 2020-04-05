{var $filter = $_modx->runSnippet("!egSitemapProd", ['filter' => [
"context" => "web",
"showHidden" => 1,
"sortby" => "uri",
"tpl" =>
('@INLINE <url>
        <loc>https://'~ $_modx->getPlaceholder('region.host') ~'/'~ $_modx->getPlaceholder('region.product_category_url') ~'/{$uri}</loc>
        <lastmod>{$date}</lastmod>
        <changefreq>{$update}</changefreq>
        <priority>{$priority}</priority>
</url>')
]
])}
{$_modx->runSnippet("pdositemap", $filter)}
{*"where" => $_modx->runSnippet('egVendorsHost',['where' => 'product.vendor:IN']),*}