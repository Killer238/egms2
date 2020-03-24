
$(document).ready(function () {
    $('.sd-city-input').keyup(function() {
        if ($(this).val() != '') {
            $('.sd-city-item').hide();
            $('.citygroup').hide();
            var s = $(this).val();
            s = s.charAt(0).toUpperCase() + s.substr(1);
            var el = $('li:contains("'+s+'")');
            el.show();
            el.parent().parent().show();

        } else {
            $('.sd-city-item').show();
            $('.citygroup').show();
        }
    });

    $(".option-select").on("change", chacgeProductPrice)

    $('#filter_reset').click(function(){
        //console.log("reset");
        mSearch2.reset();
    });

    $("body").on("change", ".option_size", chacgePrice);
    //$(document).on('#mse2_filters', chacgePrice);

    //$(".option_size").on("change", chacgePrice);

    /*megamenu*/

    $(window).resize(function(){
        if ($(window).width() >= 980){

            // when you hover a toggle show its dropdown menu
            $(".navbar .dropdown-toggle").hover(function () {
                $(this).parent().toggleClass("show");
                $(this).parent().find(".dropdown-menu").toggleClass("show");
            });

            // hide the menu when the mouse leaves the dropdown
            $( ".navbar .dropdown-menu" ).mouseleave(function() {
                $(this).removeClass("show");
            });

            // do something here
        }
    });

    $('#filterModal').on('show.bs.modal', function() {
        $('#bodyf').append($("#mse2_filters").detach());
    });
    $('#filterModal').on('hide.bs.modal', function() {
        $('#category_filter').append($("#mse2_filters").detach());
    });

    $('.btn_more').click(function() {
        var href= $('.mse2_pagination .page-item.active').next('.page-item').find('.page-link').attr('href');
        $.get(href, function(data) {
            var
                mse2_results = $('#mse2_results', data),
                mse2_pagination = $('.mse2_pagination', data);
            $('#mse2_results').append(mse2_results);
            $('.mse2_pagination').html(mse2_pagination);
        });
    });

});

function chacgeProductPrice(e){

    var size = $(this).find('option:selected').attr('data-size');
    var unit = $('#product_data').attr('data-unit');
    $('span.option_zip').text(" - " + size + " "  + unit);
}

function chacgePrice(e){
  //  $(".option_size").on("change",function(){
    //$('#msoption|size_0').
   // $("#msoption|size_0 > option[value=140x200]").prop("selected",true);
        var t = $(this).val();
        console.log(t);
        //$("#msoption").val(t);
        $('select[id*=size_]').val(t);

        $(".option_size").each(function( index ) {
            if ($(this).find('option[value=' + t + ']').length) {
                $(this).val(t);
                var id = $(this).find('option:selected').attr('data-productid');
                // update h3
                var h3 = $(this).find('option:selected').attr('data-product-name');
              //  console.log(h3);
                $('.product-'+id + ' h4 a.url-' + id + " span").text(h3);
                // update urls, h3, image, more
                var url = $(this).find('option:selected').attr('data-url');
                $('.url-'+id ).each(function(index){
                    $(this)[0].href = url;
                });
                // update price
                var price = $(this).find('option:selected').attr('data-price');
                $('.price-wrap-'+id+' div.price span').text(moneyFormat(price));
                // update old price
                var old_price = $(this).find('option:selected').attr('data-old-price');
                $('.price-wrap-'+id+' del.price-old span').text(moneyFormat(old_price));
                // update diff price

                //delivery
                var delivery_price = $(this).find('option:selected').attr('data-delivery-price');
               // console.log(delivery_price);
                if(delivery_price==0){
                    $('.card__delivery_'+id+' span.cost').text($('.card__delivery_'+id+' span.free__cost').text());
                    $('.delivery_free_info_'+id).hide();
                }
                else{
                    $('.card__delivery_'+id+' span.cost').text(moneyFormat(delivery_price)+'₽');
                    $('.delivery_free_info_'+id).show();
                }

                //console.log(delivery_price);
            }
        });
   // })
}

function moneyFormat(n) {
    return parseFloat(n).toFixed(0).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").replace('.', ',');
}
