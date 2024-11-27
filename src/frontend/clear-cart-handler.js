import swal from 'sweetalert';
import '../styles/frontend/clear-cart-popup.scss';

jQuery(document).ready(function ($) {
    $(document).on('click', '.clear-cart-button', function (e) {
        e.preventDefault();

        // Use SweetAlert for confirmation
        swal({
            title: 'Are you sure?',
            text: "Do you really want to clear the cart?",
            icon: 'warning',
            buttons: {
                confirm: 'Yes, clear it!',
                cancel: 'Cancel'
            }
        }).then((result) => {
            if (result) {
                // Proceed with clearing the cart
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
                            swal('Error', response.data, 'error');
                        }
                    },
                    error: function () {
                        swal('Error', 'Error clearing cart.', 'error');
                    }
                });
            }
        });
    });
});