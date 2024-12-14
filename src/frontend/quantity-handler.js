jQuery( document ).ready( function($) {
    $( '.single-product .quantity' ).on( 'click', '.tm-qty-plus', function() {
        const input = $(this).siblings('.qty');
        const max = parseFloat(input.attr('max')) || Infinity;
        const step = parseFloat(input.attr('step')) || 1;
        const currentValue = parseFloat(input.val()) || 0;
        if (currentValue + step <= max) {
            input.val(currentValue + step).trigger('change');
        }
    } )

    $( '.single-product .quantity' ).on( 'click', '.tm-qty-minus', function() {
        const input = $(this).siblings('.qty');
        const min = parseFloat(input.attr('min')) || 0;
        const step = parseFloat(input.attr('step')) || 1;
        const currentValue = parseFloat(input.val()) || 0;
        if (currentValue - step >= min) {
            input.val(currentValue - step).trigger('change');
        }
    } )
} )