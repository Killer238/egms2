<h3>{'eg_reviews' | lexicon}:</h3>
{if $reviews }
    {foreach $reviews as $review}
        <div class="inline-block">
            <div>
            <div class="prod-grid-stars">
                <span></span><span></span><span></span><span></span><span></span>
            </div><span><strong{$review.name}</span></span>
                </div>
            <p>{$review.comment}</p>
        </div>
    {/foreach}
{else}
{** будьте первыми **}
{/if}