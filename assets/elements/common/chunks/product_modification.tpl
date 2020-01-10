<form class="form-horizontal ms2_form  msoptionsprice-product" method="post">

    <div class="col-md-10 form-control-static">
        <label class="col-6 col-md-3 text-right text-md-left col-form-label">[[%ms2_product_price]]:</label>
        <span class='msoptionsprice-cost msoptionsprice-{$id}'>{$default.price} </span>[[%ms2_frontend_currency]]
        {*if ($default.price > $default.old_price)*}
        <span class="old_price"><span class='msoptionsprice-old-cost msoptionsprice-{$id}'>{$default.old_price} </span> </span>
        {*/if*}
    </div>

<div>
        <input type="hidden" name="id" value="{$id}"/>
        <input type="hidden" name="count" id="product_price" class="form-control col-md-6" value="1"/>
        <dl class="dlist-inline  class="p-2"">
        <dt>{'eg_size' | lexicon} </dt>
        <dd>
            <select name="options[{$name}]">
                {foreach $options as $option}
                    <option value="{$option.value}" data-size="{$option.value}" data-url="{$id | url}{$option.value}/" data-price="{$option.price}" data-old-price="{$option.old_price}"{$option.selected}>{$option.value}</option>
                {/foreach}
            </select>
        </dd>

        </dl>
        <button class="btn btn-primary btn active w-100" type="submit" name="ms2_action" value="cart/add">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
        </button>
</div>
<a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>
</form>




