
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


    $('#filter_reset').click(function(){
        console.log("reset");
        mSearch2.reset();
    });

    $(document).on('mse2_load', chacgePrice);

    $(".option_size").on("change", chacgePrice);

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

});

function chacgePrice(e){
    $(".option_size").on("change",function(){
        var t = $(this).val();
        $(".option_size").each(function( index ) {
            if ($(this).find('option[value=' + t + ']').length) {
                $(this).val(t);
                var id = $(this).find('option:selected').attr('data-productid');
                // update h3
                var h3 = $(this).find('option:selected').attr('data-product-name');
                $('.product-'+id + ' h4 a.url-' + id).text(h3);
                // update urls, h3, image, more
                var url = $(this).find('option:selected').attr('data-url');
                $('.url-'+id ).each(function(index){
                    //console.log($(this));
                    $(this)[0].href = url;
                });
                // delivery
                // update price
                // update old price
                // update diff price
                //console.log($(this));
            }
        });
    })
}