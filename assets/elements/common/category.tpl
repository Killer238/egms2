{**var $host = implode(".", array_reverse(array_slice(array_reverse(explode(".", $.server['HTTP_HOST'])), 0, 2)))**}
{var $host = $_modx->runSnippet("!egMainHost",[])}
{switch $host}
{case "mega-son.ru"}
    {include "file:templates/mega-son.ru/base_category.tpl"}

{case "hayson.ru"}
    {include "file:templates/hayson.ru/base_category.tpl"}

{case "matras-stock.ru"}
    {include "file:templates/matras-stock.ru/base_category.tpl"}

{case "test.ru"}
    {*include "file:templates/default/base_index.tpl"*}
    {include "file:templates/matras-stock.ru/base_category.tpl"}

{/switch}

