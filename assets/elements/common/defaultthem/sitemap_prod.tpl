{$_modx->runSnippet("pdositemap", [
        "context" => "web",
        "showHidden" => 1,
        "sortby" => "uri",
        "innerJoin" => '{"msProductData":{"alias":"product","on":"product.id=modResource.id"}}',
        "where" => '[[{"product.vendor:IN":'~ $_modx->getPlaceholder('region.vendors_arr') ~'}]]',
        "tpl" =>
('@INLINE <url>
        <loc>https://'~ $_modx->getPlaceholder('region.host') ~'/'~ $_modx->getPlaceholder('region.product_category_url') ~'/{$uri}</loc>
        <lastmod>{$date}</lastmod>
        <changefreq>{$update}</changefreq>
        <priority>{$priority}</priority>
</url>')
    ])}

{*"where" => $_modx->runSnippet('egVendorsHost',['where' => 'product.vendor:IN']),*}