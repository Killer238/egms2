<sitemapindex xmlns="http://wwwsitemaps.org/schemas/sitemap/0.9">
    {$_modx->runSnippet("pdoResources", [
    "parent" => $_modx->resource.id,
    "limit" => 0,
    "tpl" => "@FILE elements/common/chunks/sitemap_xml.tpl"
    ])}
</sitemapindex>