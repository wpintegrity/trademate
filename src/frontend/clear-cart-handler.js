import Swal from 'sweetalert2';

jQuery(document).ready(function ($) {
    $(document).on('click', '.clear-cart-button', function (e) {
        e.preventDefault();

        // Use SweetAlert for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to clear the cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with clearing the cart
                $.ajax({
                    url: tm_clear_cart.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'clear_cart',
                        nonce: tm_clear_cart.nonce,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            location.reload();
                        } else {
                            Swal.fire('Error', response.data, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Error clearing cart.', 'error');
                    }
                });
            }
        });
    });
});