{var $host = $_modx->runSnippet("!egMainHost",[])}
{switch $host}
{case "mega-son.ru"}
    {include "file:templates/mega-son.ru/base_text.tpl"}

{case "hayson.ru"}
    {include "file:templates/hayson.ru/base_text.tpl"}

{case "matras-stock.ru"}
    {include "file:templates/matras-stock.ru/base_text.tpl"}

{/switch}
