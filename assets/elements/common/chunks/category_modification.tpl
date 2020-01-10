<div class="price-wrap-{$id}">
    <div class="price h4">{$product_price}</div>
    <del class="price-old">{$product_old_price}</del>
    <span class="m-2 p-2" style="padding: 2px 7px;font-size: 12px;background-color: #ef5f5f;color: #fff;border-radius: 4px;">-40%</span>
</div>
<div>

    <form class="form-horizontal ms2_form  msoptionsprice-product" method="post">
        <input type="hidden" name="id" value="{$id}"/>
        <input type="hidden" name="count" id="product_price" class="form-control col-md-6" value="1"/>
        <dl class="dlist-inline  class="p-2"">
        <dt>Размер: </dt>
        <dd>
            <select name="options[{$name}]" id="option_size">
            {foreach $options as $option}
                <option value="{$option.value}" data-size="{$option.value}" data-base-url="{$base_url}" data-url="{$option.url}" data-price="{$option.price}" data-old-price="{$option.old_price}"{$option.selected}>{$option.value}</option>
            {/foreach}
            </select>
        </dd>

        </dl>
        <button class="btn btn-primary btn active w-100" type="submit" name="ms2_action" value="cart/add">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
        </button>

    </form>
</div>
<div class="p-2">
    <a href="{$product_url}" class="btn btn-secondary btn w-100">{'eg_more' | lexicon}</a>
</div>

<a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>





