<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            {var $sliders = $_modx->resource.index_slider | json_decode}
            {var $vendors = $_modx->getPlaceholder('region.vendors')}
            {foreach $sliders as $slider}
                {if ($slider.slide_vendor in list $vendors)}
                <div class="carousel-item active">
                    <img src="{$slider.slide_image}" class="d-block w-100" alt="{$slider.slide_head}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{$slider.slide_head}</h5>
                        <p>{$slider.slide_text}</p>
                    </div>
                </div>
                {/if}
            {/foreach}
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>