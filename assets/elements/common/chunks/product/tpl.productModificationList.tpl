<h3>{'eg_size' | lexicon}:</h3>
<ul class="atrs">
    {foreach $options as $option}
        {if (!$option.selected)}
            <li><a href="{$base_url}{$option.url}">{$option.value}</a></li>
        {else}
            <li>{$option.value}</li>
        {/if}
    {/foreach}
</ul>