<ul>
    {foreach $options as $option}
        {if (!$option.selected)}
            <li><a href="{$base_url}{$option.url}">{$option.value}</a></li>
        {else}
            <li>{$option.value}</li>
        {/if}
    {/foreach}
</ul>