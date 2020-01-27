{var $dh = $_modx->runSnippet("egDataHost", [])}
{var $host = $dh["region"]["host"]}
{var $pca =  $dh['region']['product_categorys']}
{var $parent = implode(",", $pca)}
{$_modx->runSnippet("pdositemap", [
        "cache_key" => $host+"-prod",
        "context" => "web",
        "parents" => $parent ,
        "showHidden" => 1,
        "sortby" => "uri",
        "innerJoin" => '{"msProductData":{"alias":"product","on":"product.id=modResource.id"}}',
        "where" => $_modx->runSnippet('egVendorsHost',['where' => 'product.vendor:IN']),
        "tpl" =>
('@INLINE <url>
        <loc>https://'~ $host ~'/'~ $dh["region"]["product_category_url"] ~'/{$uri}</loc>
        <lastmod>{$date}</lastmod>
        <changefreq>{$update}</changefreq>
        <priority>{$priority}</priority>
</url>')
    ])}