{if $reviews }
    {foreach $reviews as $review}
        <div class="inline-block">
            <div class="review--stars prod-grid-stars">
                <span></span><span></span><span></span><span></span><span></span>
            </div>
            <div class="review--name"><strong>{$review.name}</strong></div>
            <div class="review--comment"><p>{$review.comment}</p></div>
        </div>
    {/foreach}
{else}
{** будьте первыми **}
{/if}