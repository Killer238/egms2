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
                {if (array_search($slider.slide_vendor, $vendors))}
                <div class="carousel-item active">
                    <img src="{$slider.slide_image}" class="d-block w-100" alt="{$slider.slide_head}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{$slider.slide_head}</h5>
                        <p>{$slider.slide_text}</p>
                    </div>
                </div>
                {/if}
            {/foreach}
            <!--
            <div class="carousel-item active">
                <img src="assets/img/slider/1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/slider/2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            -->
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