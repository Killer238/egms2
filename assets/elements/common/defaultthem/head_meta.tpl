<title>{'!egCeoData' | snippet | ceodata: 'meta_title'}</title>
<meta charset="utf-8">
<meta name="language" content="ru" />
<base href="//{'region.host' | placeholder}" />
<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.0, initial-scale=1.0" />
<meta name="description" content="{'!egCeoData' | snippet | ceodata: 'meta_description'}">
<meta name="keywords" content="{'!egCeoData' | snippet | ceodata: 'meta_keywords'}">
<meta name="yandex-verification" content="{'region.code_yandex' | placeholder}" />
<meta name="google-site-verification" content="{'region.code_google' | placeholder}" />
{if ($_modx->resource.class_key=='msProduct')}
<link rel="canonical" href="//{'region.host' | placeholder}/{'region.product_category_url' | placeholder}/{$_modx->resource.uri}{'size' | size:'url'}" />
{else}
{if ( $_modx->resource.id | url=='/')}
<link rel="canonical" href="//{'region.host' | placeholder}" />
{else}
<link rel="canonical" href="//{'region.host' | placeholder}/{$_modx->resource.id | url}" />
{/if}
{/if}
<meta name="robots" content="{($_modx->resource.searchable)?'index, follow':'noindex, nofollow'}" />
{*<link rel="icon" type="image/png" href="/favicons/icon-70x70.png">
<link rel="icon" sizes="192x192" href="/favicons/icon-192x192.png">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/favicons/icon-152x152.png">
<link rel="mask-icon" href="/favicons/icon.svg" color="#C95040">
<link rel="manifest" href="/favicons/manifest.json">*}
{*<meta name="msapplication-config" content="/favicons/browserconfig.xml" />*}