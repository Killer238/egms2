<div class="price-wrap-{$product.product_id} prod-price">
    {if $product.price_old == 0 || $product.price_old != $product.price}
    <del class="price-old">{$product.price_old} {'ms2_frontend_currency' | lexicon}</del><span class="badge-new">{$product.price_pr}%</span>
    {/if}
    <div class="price h4">{$product.price} {'ms2_frontend_currency' | lexicon}</div>
    <!--span class="m-2 p-2" style="padding: 2px 7px;font-size: 12px;background-color: #ef5f5f;color: #fff;border-radius: 4px;">-40%</span-->
</div>
<div>
    <form class="form-horizontal ms2_form  msoptionsprice-product" method="post">
        <input type="hidden" name="id" value="product"/>
        <input type="hidden" name="count" id="product_price_{$product.product_id}" class="form-control col-md-6" value="1"/>
        <dl class="dlist-inline">
        <dt>{'ms2_take_size' | lexicon}: </dt>
        <dd>
            <select class="form-control form-control-sm option_size" name="options[{$name}]" id="option_size_{$product.product_id}">
            {foreach $options as $option}
                <option  value="{$option.value}" data-delivery-price="{($option.price<$delivery.d_min)?$delivery.d_cost:0}" data-delivery-date="{$delivery.d_time}" data-instock="{$delivery.d_instock}" data-product-name="{$option.product_name}" data-productid="{$product.product_id}" data-option="{$option.value}" data-url="{$base_category}/{$option.url}" data-price="{$option.price}" data-old-price="{$option.price_old}" {$option.selected}>{$option.value}</option>
            {/foreach}
            </select>
        </dd>
        </dl>
        <button class="btn btn-success btn active w-100" type="submit" name="ms2_action" value="cart/add">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
        </button>
    </form>
</div>
<div class="p-2">
    <a href="{$base_category}/{$product.url}" class="btn btn-secondary url-{$product.product_id} btn w-100">{'eg_more' | lexicon}</a>
</div>

{*<a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>*}





