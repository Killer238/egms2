{foreach $options as $option}
<dl class="dlist-inline">
    <dt>{$option.caption}</dt>
    <dd class="text-right">
        {if $option.value is array}
            {$option.value | join: ", "}
            {if $option.measure_unit}
                {$option.measure_unit}
            {/if}
        {else}
            {$option.value}
            {if $option.measure_unit}
                {$option.measure_unit}
            {/if}
        {/if}
    </dd>
</dl>
{/foreach}