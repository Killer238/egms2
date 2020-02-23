{foreach $options as $option}
{if ($option.value != '') }
<dl class="dlist-inline feature">

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
{/if}
{/foreach}