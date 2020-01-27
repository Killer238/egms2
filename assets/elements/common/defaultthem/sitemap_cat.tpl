{**
Выводятся страницы сайта(не товары):
вычитаются скрытые ресурсы
**}
{var $dh = $_modx->runSnippet("egDataHost", [])}
{var $host = $dh["region"]["host"]}
{var $sca =  $dh['region']['site_categorys_exc_all']}
{var $hide_res = implode(",", $sca)}
{var $vw = $_modx->runSnippet('egVendorsHost',['where' => 'access_vendor:IN'])}
{$parent}
{$_modx->runSnippet("pdositemap", [
"cache_key" => $host,
'resources' => $hide_res,
"parents" => '0' ,
"showHidden" => 1,
"sortby" => "uri",
"includeTVs" => "access_vendor",
"where" => '[['~ $vw ~',{"OR:access_vendor:IS":null}]]',
'showLog' => 0,
"tpl" =>
('@INLINE <url>
        <loc>https://'~ $host ~'/{$uri}</loc>
        <lastmod>{$date}</lastmod>
        <changefreq>{$update}</changefreq>
        <priority>{$priority}</priority>
</url>')
])}

{** "where" => , **}
{**  <loc>https://'~ $host ~'/{$uri}</loc>**}