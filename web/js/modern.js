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
        var pm_qty = $('#pqty_'+pm_id[1]).val();
        if(pm_qty*1 > 1){
            $('#pqty_'+pm_id[1]).val((pm_qty*1-1));
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
        var pp_qty = $('#pqty_'+pp_id[1]).val();
        $('#pqty_'+pp_id[1]).val((pp_qty*1+1));
        // price & cost
        var pprice = $('#pprice_'+pp_id[1]).text();
        var newcost = (pprice*(pp_qty*1+1)).toFixed(2);
        $('#pcost_'+pp_id[1]).text(newcost);
        countCartCosts();
    });

    // add product to cart
    $('.grid-buy-btn').on('click', function(e){
        e.preventDefault();
        var pid = $(this).data('id');
        var pqty = $('#pqty_'+pid).val();
        $.ajax({
            url: '/cart/add',
            data: { id : pid, qty : pqty },
            type: 'GET',
            success: function (res) {
                getCartQty();
                showCartModal(res);
            },
            error: function () {
                console.log('Add Error!');
            }
        });
    });

    // delete product from cart
    $('#modal_cart .modal-body').on('click', '.modal-del-item', function(){
        var pid = $(this).data('id');
        $.ajax({
            url: '/cart/del-item',
            data: { id : pid },
            type: 'GET',
            success: function (res) {
                getCartQty();
                showCartModal(res);
            },
            error: function () {
                console.log('Add Error!');
            }
        });
    });

    // change product qty in cart
    $('.cart-qty-oper').on('click', function(){
        var pid = $(this).data('id');
        var poper = $(this).data('oper');
        var pm_qty = $('#pqty_'+pid).val();
        var pm_check = (poper == 'minus') ? (pm_qty*1 - 1) : (pm_qty*1 + 1);
        if(pm_check > 0) {
            $.ajax({
                url: '/cart/change-qty',
                data: {id: pid, oper: poper},
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    $('#pqty_'+pid).val(res.qty);
                    $('#pcost_'+pid).text(res.cost.toFixed(2));
                    $('#cart_total').text(res.sum.toFixed(2));
                },
                error: function () {
                    console.log('Change Error!');
                }
            });
        }
    });
});

function getCartQty(){
    $.ajax({
        url: '/cart/qty',
        type: 'GET',
        success: function (res) {
            if(res*1 > 0){
                $('#top_cart_qty').text('('+res+')');
            }
            else{
                $('#top_cart_qty').text('');
            }
        },
        error: function () {
            console.log('Get Error!');
        }
    });
}

function getModalCart(){
    $.ajax({
        url: '/cart/show',
        type: 'GET',
        success: function (res) {
            getCartQty();
            showCartModal(res);
        },
        error: function () {
            console.log('Get Error!');
        }
    });
    return false;
}

function showCartModal(content){
    $('#modal_cart .modal-body').html(content);
    $('#modal_cart').modal();
}

function clearCart(){
    $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            getCartQty();
            showCartModal(res);
        },
        error: function () {
            console.log('Clear Error!');
        }
    });
}

function removeFromCart(pid){
    $.ajax({
        url: '/cart/del-product',
        data: { id : pid },
        type: 'GET',
        success: function (res) {
            res = res*1;
            getCartQty();
            $('#cart_tr_'+pid).remove();
            $('#cart_total').text(res.toFixed(2));
        },
        error: function () {
            console.log('Remove Error!');
        }
    });
}

function countCartCosts(){
    var summ = 0;
    $('.cart-cost').each(function(){
        summ += $(this).text()*1;
    });
    $('#cart_total').text(summ.toFixed(2));
}

