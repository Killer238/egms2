{if $consists }
<h3>{'eg_consist' | lexicon}:</h3>
<ul>
    {foreach $consists as $consist}
        <li>{$consist.name}</li>
    {/foreach}
</ul>
{/if}