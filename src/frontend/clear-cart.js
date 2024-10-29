jQuery(document).ready(function ($) {
    $('.clear-cart-button').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: tm_clear_cart.ajax_url,
            type: 'POST',
            data: {
                action: 'clear_cart',
                nonce: tm_clear_cart.nonce,
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.data);
                }
            },
            error: function () {
                alert('Error clearing cart.');
            }
        });
    });
});