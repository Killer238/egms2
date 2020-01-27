<h3>{'eg_reviews' | lexicon}:</h3>
{if $reviews }
    {foreach $reviews as $review}
        <div>
            <p>{$review.stars}</p>
            <p>{$review.name}</p>
            <p>{$review.comment}</p>
        </div>
    {/foreach}
{else}
{** будьте первыми **}
{/if}