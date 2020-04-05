{var $i = 1}
{var $class = ''}
<div class="row align-items-center ogg_grid"">
{foreach $options as $option}
    {if (($i%2)!=0)}
        {set $class = ""}
        {else}
        {set $class = " ogg"}
    {/if}
    <div class="col-6 p-2 text-right tex text-md-left{$class}"><strong>{$option.caption}:</strong></div>
    <div class="col-6 p-2{$class}">{if $option.value is array}
            {$option.value | join : ', '}
        {else}
            {$option.value}
        {/if}</div>
    {set $i = $i+1}
{/foreach}
</div>

{*<div class="form-group row align-items-center">
    <label class="col-6 col-md-3 text-right text-md-left col-form-label">
        {$option.caption}:</label>
    <div class="col-6 col-md-9">
        {if $option.value is array}
            {$option.value | join : ', '}
        {else}
            {$option.value}
        {/if}
    </div>
</div>*}