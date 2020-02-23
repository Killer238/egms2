<form class="form-horizontal ms2_form  msoptionsprice-product" method="post">
<div class="article">Арт. 010782</div>
    <div class="col-md-10 form-control-static price mb-2">
        <span class='msoptionsprice-cost msoptionsprice-{$id}'>{$product.price |number:0} </span> [[%ms2_frontend_currency]]
        {if ($default.old_price > 0)}
        <span class="old_price"><span class='msoptionsprice-old-cost msoptionsprice-{$id}'>{$product.old_price|number:0} </span> [[%ms2_frontend_currency]] (Экономия: {($product.price - $product.old_price) |number}  [[%ms2_frontend_currency]])</span>
        {/if}
    </div>

<div style="border-top: 1px solid #e6e6e6;">
        <input type="hidden" name="id" value="{$id}"/>
        <input type="hidden" name="count" value="1"/>
        <input type="hidden" name="options" value="[]">
        <dl class="dlist-block p-2">
        <dt>{'eg_size' | lexicon} </dt>
        <dd>
            <select class="option-select mt-2" name="options[size]">
                {foreach $options as $option}
                    <option value="{$option.value}" data-productid="{$id}" data-size="{$option.value}" data-url="{$option.value}/" data-price="{$option.price}" data-old-price="{$option.old_price}"{$option.selected}>{$option.value}</option>
                {/foreach}
            </select>
        </dd>
        <div class="instock">{'eg_instock' | lexicon}</div>
        </dl>
        <button class="btn btn-primary btn m-2 w-100" type="submit" name="ms2_action" value="cart/add">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">{'ms2_frontend_add_to_cart' | lexicon}</span>
        </button>
    <button class="btn btn-success btn m-2 active w-100" type="submit" name="ms2_action" value="cart/add">
        <i class="fa fa-shopping-cart"></i>
        <span class="text">{'eg_oneclick' | lexicon}</span>
    </button>
</div>
<a href="#"><i class="fa fa-heart"></i>{'eg_i' | lexicon}</a>
</form>




