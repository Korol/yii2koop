jQuery(document).ready(function($) {
    $('.product-thumbnail').hover(function() {
        /* Stuff to do when the mouse enters the element */
        $('#btns_'+this.id).addClass('in');
        $('#'+this.id).addClass('pt-shadow');
    }, function() {
        /* Stuff to do when the mouse leaves the element */
        $('#btns_'+this.id).removeClass('in');
        $('#'+this.id).removeClass('pt-shadow');
    });

    $(".fancybox").fancybox();

    // minus
    $('.pqminus').click(function(event) {
        var pm_id = this.id.split('_');
        var pm_qty = $('#pqty_'+pm_id[1]).val();
        if(pm_qty*1 > 1){
            $('#pqty_'+pm_id[1]).val((pm_qty*1-1));
        }
    });

    // plus
    $('.pqplus').click(function(event) {
        var pp_id = this.id.split('_');
        var pp_qty = $('#pqty_'+pp_id[1]).val();
        $('#pqty_'+pp_id[1]).val((pp_qty*1+1));
    });

    // minus with price
    $('.ppqminus').click(function(event) {
        var pm_id = this.id.split('_');
        var pm_qty = $('#ppqty_'+pm_id[1]).val();
        if(pm_qty*1 > 1){
            $('#ppqty_'+pm_id[1]).val((pm_qty*1-1));
            // price & cost
            var pprice = $('#pprice_'+pm_id[1]).text();
            var newcost = (pprice*(pm_qty*1-1)).toFixed(2);
            $('#pcost_'+pm_id[1]).text(newcost);
            countCartCosts();
        }
    });

    // plus with price
    $('.ppqplus').click(function(event) {
        var pp_id = this.id.split('_');
        var pp_qty = $('#ppqty_'+pp_id[1]).val();
        $('#ppqty_'+pp_id[1]).val((pp_qty*1+1));
        // price & cost
        var pprice = $('#pprice_'+pp_id[1]).text();
        var newcost = (pprice*(pp_qty*1+1)).toFixed(2);
        $('#pcost_'+pp_id[1]).text(newcost);
        countCartCosts();
    });
});

function removeFromCart(p_id){
    $('#cart_tr_'+p_id).remove();
    countCartCosts();
}

function countCartCosts(){
    var summ = 0;
    $('.cart-cost').each(function(){
        summ += $(this).text()*1;
    });
    $('#cart_total').text(summ.toFixed(2));
}

